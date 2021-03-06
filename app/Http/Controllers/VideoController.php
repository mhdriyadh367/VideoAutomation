<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use FFMpeg;

use App\Models\Photo;
use App\Models\Video;
use App\Http\Controllers\MP3;

class VideoController extends Controller
{
    public function store_video(Request $request)
    {
        $rules = [
            'text' => 'required',
            'text.*' => 'string',
            'photo' => 'required',
            'photo.*' => 'image',
        ];

        // $this->validate($request, $rules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json( [ 'success' => false, 'message'=> $validator->errors()] );
        }

        $video = Video::create();

        return response()->json([ 'success' => true, 'id'=> $video->id]);
    }

    public function merge_video(Request $request)
    {
        // $process = new Process(["python3","video_merge.py",$request->input('id')]);
        // $process->run();

        // if (!$process->isSuccessful()) {
        //     throw new ProcessFailedException($process);
        //     return response()->json([ 'success' => false, 'message'=> $process]);
        // } else {
        //     return response()->json([ 'success' => true, 'message'=> 'success', 'id' => $request->input('id')]);
        // }

        $id = $request->input('id');

        $photos = Photo::where('video_id', $id)->get();
        $slides = [];

        foreach($photos as $photo) {
            array_push($slides, 'public/'.$photo->video);
        }

        $name = 'mv_'.Date('mdYHis').uniqid().'.mp4';
        $output = 'assets/video/'.$name.'.mp4';

        $test = FFMpeg::open($slides)
        ->export()
        ->concatWithoutTranscoding()
        ->save('public/'.$output);

        $video = Video::where('id', $id)
        ->update(['video' => $output]);

        if($video) {
            return response()->json([ 'success' => true, 'message'=> $id]);
        } else {
            return response()->json([ 'success' => false, 'message'=> 'Something error']);
        }

    }

    public function merge_video_coba(Request $request)
    {
        // $id=76;
        $id = $request->input('id');

        $photos = Photo::where('video_id', $id)->get();
        $slides = [];

        foreach($photos as $photo) {
            array_push($slides, 'public/'.$photo->video);
        }

        $name = 'mv_'.Date('mdYHis').uniqid().'.mp4';
        $output = 'assets/video/'.$name.'.mp4';

        $test = FFMpeg::open($slides)
        ->export()
        ->concatWithoutTranscoding()
        ->save('public/'.$output);

        $video = Video::where('id', $id)
        ->update(['video' => $output]);

        if($video) {
            return response()->json([ 'success' => true, 'message'=> $video->id]);
        } else {
            return response()->json([ 'success' => false, 'message'=> 'Something error']);
        }

    }

    public function coba(Request $request)
    {
        $rules = [
            'text' => 'required|string',
            'photo' => 'required|image',
            'video_id' => 'required|integer'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json([ 'success' => false, 'message'=> $validator->errors()]);
        }

        $path = 'assets/music/';
        $name = Date('mdYHis').uniqid().'.mp3';

        $mp3_name = $path.$name;
        //Prosa AI
        //$process_tts = $this->ttsProsa($request, $mp3_name);
            
        $photo = $request->file('photo')->store(
            'assets/photo', 'public'
        );

        $store_photo = Photo::create([
            'text' => $request->input('text'),
            'photo' => $photo,
            'video_id' => $request->input('video_id'),
            'audio' => $mp3_name,
        ]);

        $process = new Process(["python3","gtts_mp3.py",$store_photo->id]);
        $process->run();

        $process = new Process(["python3","video3_copy.py",$store_photo->id]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
            return response()->json([ 'success' => false, 'message'=> $process]);
        } else {
            return response()->json([ 'success' => true, 'message'=> 'success', 'id' => $store_photo->id]);
        }

    }

    public function index()
    {
        return view('pages.video.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'text' => 'required',
            'text.*' => 'string',
            'photo' => 'required',
            'photo.*' => 'image',
        ];

        // $this->validate($request, $rules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json([ 'success' => false, 'message'=> $validator->errors()]);
        }
        else 
        {
        
            $video = Video::create();

            foreach($request->file('photo') as $key => $value) {

                $photo = $value->store(
                    'assets/photo', 'public'
                );

                Photo::create([
                    'text' => $request->input('text')[$key],
                    'photo' => $photo,
                    'video_id' => $video->id
                ]);
            }

            // $data = $request->all();
            // $data['video_id'] = $video->id;
            // $data['photo'] = $request->file('photo')->store(
            //     'assets/photo', 'public'
            // );
            // $photo = Photo::create($data);
            
            set_time_limit(0);
            $process = new Process(["python3","video2.py",$video->id]);
            $process->run();

            // executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
                return response()->json([ 'success' => false, 'message'=> $process]);
            } else {
                return response()->json([ 'success' => true, 'message'=> 'success', 'id' => $video->id]);
                // return redirect()->route('video.show', $video->id);
            }

        }

    }

    public function show($id)
    {
        $video = Video::find($id);

        return view('pages.video.show', compact('video'));
    }


    protected function ttsProsa(Request $request, $mp3_name)
    {
        $body = [
            "config" => [
                "engine" => "tts-dimas-formal",
                "wait" => 0,
                "pitch" => 0,
                "tempo" => 1,
                "audio_format" => "opus"
            ],
            "request" => [
                "label" => "string",
                "text" => $request->input('text'),
                "as_data" => 0
            ]
        ];
        send_tts:
        $url_tts = 'https://api.prosa.ai/v2/speech/tts-api?as_signed_url=true';
        $response_post_tts= Http::withHeaders([
            'x-api-key' => env('API_KEY_PROSA'),
        ])->post($url_tts, $body);
        
        if ( !$response_post_tts->successful())
        {
            return response()->json([ 'success' => false, 'message'=> $response_post_tts->json()['message'] ]);
        }

        $result_post_tts = $response_post_tts->json();
        $id = $result_post_tts['job_id'];
        
        $url_get_tts = 'https://api.prosa.ai/v2/speech/tts-api/'.$id.'?as_signed_url=true';

        get_tts:
        $response_get_tts = Http::withHeaders([
            'x-api-key' => env('API_KEY_PROSA'),
        ])->get($url_get_tts);
    
        if ( !$response_get_tts->successful())
        {
            return response()->json([ 'success' => false, 'message'=> $response_get_tts->json()['message'] ]);
        }

        $result_tts = $response_get_tts->json();
        $status = $result_tts['status'];
        // $i = $i + 1;

        if( $result_tts['status'] == 'in_progress' ) goto get_tts;
        
        if( $result_tts['result']['duration'] == '0.0' ) goto send_tts;

        // return response()->json([ 'success' => false, 'message'=> 'loop= '.$i ]);
        
        $url = $result_tts['result']['path'];
        $contents = file_get_contents($url);

        $save_mp3 = 'public/'.$mp3_name;
            
        return Storage::put($save_mp3, $contents);
    }

    public function tes(Request $request)
    {
        $mp3file = new MP3("storage/assets/music/093020210459106155441ee8851.mp3");//http://www.npr.org/rss/podcast.php?id=510282
        // $duration1 = $mp3file->getDuration();//(faster) for CBR only
        $duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
        // echo "duration: $duration1 seconds"."\n";
        echo "estimate: $duration2 seconds"."\n";
        echo MP3::formatTime($duration2)."\n";
    }
}
