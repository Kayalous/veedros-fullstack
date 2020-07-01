<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Mail\WelcomeVerificationMail;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;
use Sopamo\LaravelFilepond\Exceptions\InvalidPathException;

class ContactController extends Controller
{
    public function teach(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'phone' => 'required|max:16|min:8',
            'email' => 'required|email|max:100',
            'body' => 'required|max:500',
        ]);
        $request['type'] = 'teach-application';
        if($request['filepond'] === null){
            Session::flash('message',"You need to upload your CV.");
            return back();
        }
        else{
            $path = $this->getPathFromServerId($request['filepond']);
            $file = new File($path);
            $fileUrl = Storage::disk('s3')->put('contact/teach', $file);
            $fileUrl = 'https://veedros.s3.eu-central-1.amazonaws.com/' . $fileUrl;
            $request['attachment'] = $fileUrl;
        }
        $contact = Contact::create(array_filter($request->all()));
//        Mail::to("$contact->email")->send(new TeachApplicationRecieved($contact));
        Session::flash('success',"We've received your application and we'll be in contact with you as soon as we can!");
        return back();
    }
    private function getPathFromServerId($serverId) {
        if(!trim($serverId)) {
            throw new InvalidPathException();
        }
        $filePath = Crypt::decryptString($serverId);
        if(!Str::startsWith($filePath, config('filepond.temporary_files_path'))) {
            throw new InvalidPathException();
        }
        return $filePath;
    }
}
