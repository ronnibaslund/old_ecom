<?php

namespace App\Http\Controllers;

use App\Medias;
use App\MediaToProduct;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        // Create media dir if not exist
        if(!is_dir(public_path('media'))) {
            //Storage::makeDirectory('media');
            if (!mkdir(public_path('media'), 0777, true)) {
                die('Failed to create folders...');
            }
        }

        if(!isset($_GET['path'])) {
            $path = 'media';
        } else {
            $path = $_GET['path'];
        }

        $data = array(
            'page_title' => 'Medier',
            'dirs' => glob($path . '/*', GLOB_ONLYDIR),
//            'files' => array_filter(glob($path .'/*'), 'is_file'), //Storage::files($path),
            'files' => Medias::where('path', '=', $path.'/')->get(),
            'path' => $path
        );

        return view('admin.media.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->file('file')->isValid()) {

            $file = $request->file('file');

            $destinationPath = public_path($request->get('path'));
            $filename = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();

            $filename = str_replace($ext, '', $filename);
            $filename = str_replace(' ', '_', $filename);
            $filename = str_replace('.', '', $filename);
            $filename = str_replace('/', '', $filename);

            $path = $request->get('path') . '/' . $filename . '.' . $ext;

            $upload_success = $file->move($destinationPath, $filename . '.' . $ext);

            if ($upload_success) {

                // resizing an uploaded file

                $media = new Medias();
                $media->file = $filename . '.' . $ext;
                $media->title = $filename;
                $media->path = $request->get('path').'/';
                $media->save();

                $data = array(
                    'name' => $filename,
                    'path' => $path
                );


                return Response::json($data, 200);
            } else {
                return Response::json('error', 400);
            }
        } else {
            return Response::json('error', 400);
        }
    }

    public function showImage ($id) {

        $file = Medias::find($id);

        return view('admin.media.editimage', [ 'file' => $file ]);
    }

    public function updateImage(Request $request, $id) {

        $media = Medias::find($id);
        $media->title = $request->name;
        $media->description = $request->description;
        $media->save();

        $data = array(
            'error' => 'success',
            'name' => $request->name,
            'id' => $id
        );

        return Response::json($data);

    }

    public function allImagesModal($id) {

        // Get all predocts medias so we can exclud them from images
        $meidas = MediaToProduct::select('media_id')->where('product_id', '=', $id)->get();

        // Get all images not belongs to the image already
        $images = Medias::whereNotIn('id', $meidas)->get();

        return view('admin.media.product_image_modal', [ 'images' => $images, 'product_id' =>  $id]);
    }

    public function storeProductImages(Request $request) {

        $product_id = $request->get('product_id');
        $imagesToSave = $request->get('images');

        $images = array();

        if(is_array($imagesToSave)) {
            foreach($imagesToSave as $media_id):
                // find first or create a new entry in the database
                $media_product = MediaToProduct::firstOrNew(['media_id'=> $media_id, 'product_id'=>$product_id]);
                $media_product->save();
                $images[] = $media_product->media;

            endforeach;
        }

        $data = array(
            'error' => 'success',
            'images' => $images,
            'product_id' => $product_id
        );

        return Response::json($data);
    }

    public function deleteProductImage(Request $request, $id) {
        $product_id = $request->get('product_id');

        MediaToProduct::where('product_id', '=', $product_id)->where('media_id', '=', $id)->delete();
        return redirect("admin/product/$product_id/edit");
    }

    /**
     * Show the form for creating a new folder.
     *
     * @param  Request  $request
     * @return Response
     */
    public function createFolder(Request $request) {

        $data = array(
            'page_title' => 'Opret mappe',
            'path' => $request->get('path')
        );

        return view('admin.media.createfolder')->with($data);
    }

    /**
     * Store a newly created folder in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storeFolder(Request $request)
    {
        //
        // Create media dir if not exist
        if(!is_dir(public_path($request->get('path') . '/' . $request->get('name')))) {

            if (!mkdir(public_path($request->get('path') . '/' . str_replace(' ', '', $request->get('name'))), 0777, true)) {
                die('Failed to create folders...');
            }
        }

        return redirect('/admin/media?path=' . $request->get('path'));
    }

    /**
     * Remove the specified fodler from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyFolder(Request $request)
    {
        // Slet alle billeder der ligger i mappen
        $files = Medias::where('path', '=', $request->get('folder').'/')->get();
        foreach($files as $file):
            $f = public_path($file->path . $file->file);
            unlink($f);
            $file->delete();
        endforeach;

        // Delete folder
        if(is_dir(public_path($request->get('folder')))) {
            rmdir(public_path($request->get('folder')));
        }

        return redirect('/admin/media?path=' . $request->get('path'));
    }
}
