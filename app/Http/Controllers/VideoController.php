<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

use App\Models\Photo;
use App\Models\Video;

class VideoController extends Controller
{
    public function store_video(Request $request)
    {
        $rules = [
            'text' => 'required',
            'text.*' => 'string|max:280',
            'photo' => 'required',
            'photo.*' => 'image',
        ];

        // $this->validate($request, $rules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json([ 'success' => false, 'message'=> $validator->errors()]);
        }

        $video = Video::create();

        return response()->json([ 'success' => true, 'id'=> $video->id]);
    }

    public function merge_video(Request $request)
    {
        $process = new Process(["python3","video_merge.py",$request->input('id')]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
            return response()->json([ 'success' => false, 'message'=> $process]);
        } else {
            return response()->json([ 'success' => true, 'message'=> 'success', 'id' => $request->input('id')]);
        }
    }

    public function coba(Request $request)
    {
        $rules = [
            'text' => 'required|string|max:280',
            'photo' => 'required|image',
            'video_id' => 'required|integer'
        ];

        // $this->validate($request, $rules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) 
        {
            return response()->json([ 'success' => false, 'message'=> $validator->errors()]);
        }

        $body = [
            "config" => [
                "engine" => "tts-dimas-formal",
                "wait" => 1,
                "pitch" => 0,
                "tempo" => 1,
                "audio_format" => "opus"
            ],
            "request" => [
                "label" => "string",
                "text" => $request->input('text'),
                "as_data" => 1
            ]
        ];
        
        $url_tts = 'https://api.prosa.ai/v2/speech/tts-api?as_signed_url=true';
        $response = Http::withHeaders([
            'x-api-key' => env('API_KEY_PROSA'),
        ])->post($url_tts, $body);
        
        if ( !$response->successful())
        {
            return response()->json([ 'success' => false, 'message'=> $response->json()['message'] ]);
        }

        $result_tts = $response->json();

        $url = $result_tts['result']['path'];
        $contents = file_get_contents($url);

        $path = 'assets/music/';
        $name = Date('mdYHis').uniqid().'.mp3';
        $save_mp3 = 'public/'.$path.$name;
            
        $result = Storage::put($save_mp3, $contents);
            
        $photo = $request->file('photo')->store(
            'assets/photo', 'public'
        );

        $store_photo = Photo::create([
            'text' => $request->input('text'),
            'photo' => $photo,
            'video_id' => $request->input('video_id'),
            'audio' => $path.$name,
        ]);

        $process = new Process(["python3","video3.py",$store_photo->id]);
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
}
