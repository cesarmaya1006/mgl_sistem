<?php

namespace App\Http\Controllers\Proyectos;

use App\Http\Controllers\Controller;
use App\Models\Proyectos\Historial;
use App\Models\Proyectos\HistorialDoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HistorialDocController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($proy_historiales_id)
    {
        $historial = Historial::findOrFail($proy_historiales_id);
        return view('intranet.proyectos.historial.subirdoc', compact('historial','proy_historiales_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $historial = Historial::findOrFail($request['proy_historiales_id']);
        if ($request->hasFile('doc_historial')) {
            $this->guardar_archivos($request['doc_historial'], $historial->id);
        }
        return redirect('dashboard/proyectos/tareas/gestion/' . $historial->tarea->id)->with('mensaje', 'Documento(s) creado(s) con éxito');
    }

    public function guardar_archivos($doc_historial, $proy_historiales_id)
    {
        $i = 0;
        //dd($doc_historial);
        foreach ($doc_historial as $archivo) {
            $i++;
            $extension = $archivo->extension();
            $titulo = utf8_encode(utf8_decode($archivo->getClientOriginalName()));
            $tipo = $this->mime_content_type($titulo);
            $url = time() . '-' . utf8_encode(utf8_decode($archivo->getClientOriginalName()));
            $peso = filesize($archivo) / 1000000;
            $new_proy_historialdoc['proy_historiales_id'] = $proy_historiales_id;
            $new_proy_historialdoc['titulo'] = $titulo;
            $new_proy_historialdoc['tipo'] = $tipo;
            $new_proy_historialdoc['url'] = $url;
            $new_proy_historialdoc['peso'] = $peso;
            // - - - - - - - - - - - - - - - - - - - - - - - -
            $ruta = Config::get('constantes.folder_doc_historial');
            $ruta = trim($ruta);
            $doc_subido = $archivo;
            $doc_subido->move($ruta, $url);
            // - - - - - - - - - - - - - - - - - - - - - - - -
            HistorialDoc::create($new_proy_historialdoc);
        }
    }

    public function mime_content_type($filename)
    {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',
            'docx' => 'application/msword',
            'rtfx' => 'application/rtf',
            'xlsx' => 'application/vnd.ms-excel',
            'pptx' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = $file_extension = pathinfo($filename, PATHINFO_EXTENSION);;
        if (array_key_exists($file_extension, $mime_types)) {
            return $mime_types[$file_extension];
        } elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        } else {
            return 'application/octet-stream';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialDoc $historialDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialDoc $historialDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialDoc $historialDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialDoc $historialDoc)
    {
        //
    }
}
