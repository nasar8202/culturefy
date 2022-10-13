<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyAndUpload(Request $request, $fieldname = 'image', $directory = 'Package/images' ) {

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();

            }

            return $request->file($fieldname)->store($directory, 'public');

        }

        return null;

    }

    public function verifyAndUploadCourse(Request $request, $fieldname = 'image', $directory = 'Course/images' ) {

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();

            }

            return $request->file($fieldname)->store($directory, 'public');

        }

        return null;

    }

    public static function getCoursePicture($request, $size = false)
    {

        Storage::delete($request->image); //<- here I intend to delete the file in https://mydomain.com//storage/avatars/rasputin-1583231825.png

       // more code here
    }
    public function verifyAndUploadCourseTutor(Request $request, $fieldname = 'image', $directory = 'Course/Tutor/images' ) {

        if( $request->hasFile( $fieldname ) ) {

            if (!$request->file($fieldname)->isValid()) {

                flash('Invalid Image!')->error()->important();

                return redirect()->back()->withInput();

            }

            return $request->file($fieldname)->store($directory, 'public');

        }

        return null;

    }



}
