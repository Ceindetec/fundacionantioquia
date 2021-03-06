<?php

namespace App\Http\Controllers;

use App\Albun;
use App\Imagen;
use App\Servicio;
use App\Texto;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Tests\DataCollector\DumpDataCollectorTest;

class AdminController extends Controller
{
    public function editHome()
    {
        $texto = Texto::where('vista', '=', 'index')->get();
        $album = Albun::where('tipo', '=', 'S')->first();
        $album->getImagenes;

        $servicios = Servicio::where('nombre', '=', 'servicio')->get();

        $data['servicios'] = $servicios;
        $data['texto'] = $texto;
        $data['galeria'] = $album;
//        dd($data);
        return view('admin.index', $data);
    }

    public function subirImagen(Request $request)
    {
        $fotos = $request->file('inputGalery');
        if ($fotos != null) {
            DB::beginTransaction();
            try{
                $fotos = $fotos[0];
                $extension = explode(".", $fotos->getClientOriginalName());
                $cantidad = count($extension) - 1;
                $extension = $extension[$cantidad];
                $nombre = time() . $request->file_id . "." . $extension;

                $imagen = new Imagen();
                $imagen->albun_id = $request->album;
                $imagen->url = $nombre;
                $imagen->save();
                $fotos->move('images', utf8_decode($nombre));

                $album = Albun::find($request->album);
                if($album->tipo == 'A'){
                    if(strtolower ($extension) == 'jpg') {
                        $estampa = imagecreatefromjpeg("images/" . utf8_decode($nombre));
                    }
                    else {
                        $estampa = imagecreatefrompng("images/" . utf8_decode($nombre));
                    }

                    list($ancho, $alto) = getimagesize("images/" . utf8_decode($nombre));

                    $temp = imagecreatetruecolor(480,480);
                    imagecopyresampled($temp, $estampa, 0, 0, 0, 0, 480, 480, $ancho, $alto);
                    imagedestroy($estampa);

                    if(strtolower ($extension) == 'jpg') {
                        imagejpeg($temp, 'images/thumbs/'.$nombre, 95);
                    }
                    else {
                        imagepng($temp, 'images/thumbs/'.$nombre);
                    }
                }
                DB::commit();
                return json_encode(array('ruta' => $nombre, 'id' => $imagen->id));
            }catch(\Exception $e){
                DB::rollBack();
                return json_encode(array('error' => "No se pudo eliminar la imagen, " . $e->getMessage()));
            }
        } else
            return json_encode(array('error' => 'Archivo no permitido'));
    }

    public function deleteImage(Request $request)
    {
        DB::beginTransaction();
        try {
            $imagen = Imagen::find($request->input('id'));
            $imagen->getAlbum;
            unlink('images/' . utf8_decode($request->input('ruta')));
            if($imagen->getAlbum->tipo == 'A')
                unlink('images/thumbs/' . utf8_decode($request->input('ruta')));
            $imagen->delete();
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "No se pudo eliminar la imagen, " . $e->getMessage()];
        }

        return $data;
    }

    public function editTexto(Request $request)
    {
        foreach ($request->all() as $texto) {
            $arrayTexto = json_decode($texto);
            $rta = $this->updateTexto($arrayTexto);
            if ($rta['estado'] == false)
                return $rta['mensaje'];
        }
        return 'exito';
    }

    public function editRequisitos()
    {
        $pdf = Texto::where('titulo', '=', 'pdf')->first();
        $data['pdf'] = $pdf;
        return view('admin.pdf', $data);
    }

    public function editServicios()
    {
        $textos = Texto::where('vista', '=', 'servicios')->get();
        $data = array();
        foreach ($textos as $texto){
            $data[$texto->titulo]=$texto;
        }

        $imagen = Servicio::where('nombre', '=', 'vinculacion')->first();
        $data['imagen'] = $imagen;

        return view('admin.servicios', $data);
    }

    public function editVinculo(Request $request)
    {
        $file = $request->file('vinculo');
        if ($file != null){
            $name = time().$file->getClientOriginalName();
            $arrayImgOld = json_decode($request->imgBorrar);
            DB::beginTransaction();
            try {
                $imagen = Servicio::find($arrayImgOld->id)->update(['imagen' => $name]);
                DB::commit();
                $file->move('images', $name);
                unlink("images/".utf8_decode($arrayImgOld->ruta));
                $data = ["imagen" => true, "mensajeImg" => "exito", 'nueva' => $name];
            } catch (\Exception $e) {
                DB::rollBack();
                $data = ["imagen" => false, "mensajeImg" => $e->getMessage()];
            }
        }

        $rta = $this->updateTexto(json_decode($request->texto));
        $data['texto'] = $rta['estado'];
        $data['mensajeTexto'] = $rta['mensaje'];

        return $data;
    }

    public function updateTexto($arrayTexto)
    {
        DB::beginTransaction();
        try {
            $texto = Texto::find($arrayTexto->id)->update(['texto' => $arrayTexto->texto]);
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error:" . $e->getMessage()];
        }
        return $data;
    }

    /**
     * @return array
     */
    public function nuevoAdmin()
    {
        $users = User::where("rol", "admin")->get();
        $data["users"] = $users;
        return view('superAdmin.addAdmin', $data);
    }

    /**
     * @return string
     */
    public function addAdmin(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = new User($request->all());
            $user->password = bcrypt($request->telefono);
            $user->avatar = "avatar.png";
            $user->rol = "admin";
            $user->save();

            DB::table('password_resets')->insert(
                ['email' => $request->email, 'token' => $request->_token, 'created_at' => Carbon::now()]
            );
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
    }

    /**
     * @return array
     */
    public function editAdmin(Request $request)
    {
        DB::beginTransaction();
        try {

            $user = User::find($request->id)->update($request->all());

            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
    }

    /**
     * @return array
     */
    public function getAdmins()
    {
        $users = User::where("rol", "admin")->get();
        $data["users"] = $users;
        return view('superAdmin.admins', $data);
    }

    /**
     * @return array
     */
    public function removeAdmins(Request $request)
    {

        DB::beginTransaction();
        try {

            User::find($request->id)->delete();

            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;

    }

    /**
     * @return array
     */
    public function perfil()
    {
        return view('admin.perfil');
    }

    /**
     * @return string
     */
    public function cambiarPassword(Request $request)
    {

        $data["mensaje"] = "";

        if (\Hash::check($request->passwordA, \Auth::user()->password)) {

            if ($request->password == $request->passwordC) {
                $user = User::find(\Auth::user()->id)->update(['password' => bcrypt($request->password)]);

                $data["mensaje"] = "la contraseña fue cambiada exitosamente.";
                $data["bandera"] = true;
                return $data;
            } else {
                $data["mensaje"] = "las Contraseñas no coinciden";
                $data["bandera"] = false;
                return $data;
            }

        } else {
            $data["mensaje"] = "la contraseña actual no coincide con nuestros registros";
            $data["bandera"] = false;
            return $data;
        }

    }

    /**
     * @return array
     */
    public function actualizarAvatar(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::find($request->id);
            $user->avatar=$request->avatar;
            $user->save();

            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
    }

    public function insertServicio(Request $request)
    {
        $file = $request->file('fotoServicio');
        if ($file != null){
            $name = time().$file->getClientOriginalName();
            $extension = explode(".", $file->getClientOriginalName());
            $cantidad = count($extension) - 1;
            $extension = $extension[$cantidad];


            //dd($extension);
            DB::beginTransaction();
            try {
                $servicio = new Servicio();
                $servicio->nombre = 'servicio';
                $servicio->descripcion = $request->titulo;
                $servicio->imagen = $name;
                $servicio->save();

                $file->move("images/" , utf8_decode($name));

                if(strtolower ($extension) == 'jpg') {
                    $estampa = imagecreatefromjpeg("images/" . utf8_decode($name));
                }
                else {
                    $estampa = imagecreatefrompng("images/" . utf8_decode($name));
                }

                list($ancho, $alto) = getimagesize("images/" . utf8_decode($name));

                $temp = imagecreatetruecolor(480,300);
                imagecopyresampled($temp, $estampa, 0, 0, 0, 0, 480, 300, $ancho, $alto);
                imagedestroy($estampa);

                if(strtolower ($extension) == 'jpg') {
                    imagejpeg($temp, 'images/'.$name, 95);
                }
                else {
                    imagepng($temp, 'images/'.$name);
                }

                DB::commit();
                $data = ["estado" => true, "mensaje" => "exito", 'nueva' => $name, 'id' => $servicio->id, 'titulo' => $servicio->descripcion];
            } catch (\Exception $e) {
                DB::rollBack();
                $data = ["estado" => false, "mensaje" => $e->getMessage()];
            }
        }
        else{
            $data = ["estado" => false, "mensaje" => 'No se encontró una imagen válida para asociar al servicio.'];
        }
        return $data;
    }

    public function deleteServicio(Request $request)
    {
        DB::beginTransaction();
        try{
            Servicio::where('id', $request->id)->delete();
            DB::commit();
            unlink('images/' . utf8_decode($request->input('ruta')));
            $data = ["estado" => true, "mensaje" => 'exito'];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => $e->getMessage()];
        }
        return $data;
    }

    public function editGalerias()
    {
        $albums = Albun::where('tipo', '=', 'A')->get();
        foreach ($albums as $album){
            $album->cantImgs = count($album->getImagenes);
            $album->portada = $album->getImagenes->first();
        }
//        dd($albums);
        $data['albums'] = $albums;
        return view('admin.galerias', $data);
    }

    public function editAlbum($id)
    {
        $album = Albun::find($id);
        if($album == null || $album->tipo != 'A')
            return redirect()->back();
        else{
            $album->getImagenes;
            $data['album'] = $album;
            return view('admin.album', $data);
        }
    }

    public function deleteAlbum(Request $request)
    {
        DB::beginTransaction();
        try {
            $album = Albun::find($request->input('id'));
            $album->getImagenes;
            foreach ($album->getImagenes as $imagen){
                unlink("images/".utf8_decode($imagen->url));
                unlink("images/thumbs/".utf8_decode($imagen->url));
            }
            $album->delete();
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "No se pudo eliminar el álbum imagen, " . $e->getMessage()];
        }
        return $data;
    }

    /**
     * @return array
     */
    public function somos()
    {

        $textos = Texto::whereIn("titulo",["somos","vision","mision","modelo"])->get();
        $imageSomos = Servicio::where("nombre","somos")->first();
        $data = array();
        $data["somos"] = $textos->whereIn("titulo",["somos"])->first();
        $data["vision"] = $textos->whereIn("titulo",["vision"])->first();
        $data["mision"] = $textos->whereIn("titulo",["mision"])->first();
        $data["modelo"] = $textos->whereIn("titulo",["modelo"])->first();

        $data["imageSomos"]= $imageSomos;

        return view('admin.somos',$data);
    }

    public function updateImagSomos(Request $request)
    {
        DB::beginTransaction();
        try {
        $imagen = Servicio::where("nombre","somos")->first();
        unlink("images/".utf8_decode($imagen->imagen));

        $file = $request->file('file');
        $name = time().$file->getClientOriginalName();
        $file->move('images', $name);

        $imagen->imagen=$name;
        $imagen->save();

            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito","url"=>$name];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
    }

    public function videos()
    {

        $videos = Video::all();

        $data["videos"]=$videos;
        return view('admin.videos',$data);
    }


    public function subirVideo(Request $request){

        $videos = $request->file('inputGalery');

        if ($videos != null) {
            $videos = $videos[0];

            $extension = explode(".", $videos->getClientOriginalName());
            $cantidad = count($extension) - 1;
            $extension = $extension[$cantidad];
            $nombre = time() . $request->file_id . "." . $extension;

            $videos->move('videos', utf8_decode($nombre));

            $video = new Video();
            $video->titulo="Sin Titulo";
            $video->url = $nombre;
            $video->descripcion= "...";
            $video->save();

            return json_encode(array('url' => $nombre, 'id' => $video->id,'titulo'=>$video->titulo,'descripcion'=>$video->descripcion));
        } else
            return json_encode(array('error' => 'Archivo no permitido'));


    }

    public function editInfoVideo(Request $request){
        DB::beginTransaction();
        try {
        $video = Video::find($request->id)->update($request->all());
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
    }

    public function removeVideo(Request $request){
        DB::beginTransaction();
        try {
            $video = Video::find($request->id);
            $url = $video->url;
            $video->delete();
                unlink('videos/' . utf8_decode($url));
            
            DB::commit();
            $data = ["estado" => true, "mensaje" => "exito"];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ["estado" => false, "mensaje" => "error en la transaccion, intentar nuevamente." . $e->getMessage()];
        }
        return $data;
        }

    public function subirAlbum(Request $request)
    {
        DB::beginTransaction();
        try {
            $album = new Albun($request->all());
            $album->tipo = 'A';
            $album->save();
            DB::commit();
            return redirect()->to(route('editAlbum', $album->id));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->to(route('editGalerias'));
        }

    }

    public function updateAlbum(Request $request)
    {
        DB::beginTransaction();
        try {
            $album = Albun::find($request->id);
            $album->nombre = $request->nombre;
            $album->save();
            DB::commit();
            return "exito";
        } catch (\Exception $e) {
            DB::rollBack();
            return "No se pudo actualizar el nombre del álbum, " . $e->getMessage();
        }
    }
}
