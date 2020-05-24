<?php

namespace App\Aves;

use Illuminate\Database\Eloquent\Model;
use App\Lote;
use App\Aviario;
class Mortalidade extends Model
{
   protected $primaryKey = 'id_mortalidade';
    public  $incrementing = false;
    protected $fillable = [
        'id_mortalidade',
        'id_aviario',
        'data_mortalidade',
        'periodo',
        'lote_id',
        'femea',
        'macho',
        'tot_ave',
        'motivo'
    ];
    
    
    public function lote() {
        return $this->belongsTo(Lote::class, 'lote_id');
    }
    
    public function nextAve($search) {
        return Mortalidade::where('lote_id', $search)->orderBy('id_mortalidade', 'desc')->first();
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastmortalidade() {
        $lastmortalidade = Mortalidade::orderBy('id_mortalidade', 'desc')->get();

        if ($lastmortalidade->count() > 0):
            foreach ($lastmortalidade as $last):
                return $last->id_mortalidade + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
    
    public function getAviarios($idlote = 0)
    {
        $aviarios = Aviario::where('lote_id', $idlote)->get();
        return $aviarios;
    }
    
    public function numaviario($idaviario){
        $aviarios = Aviario::where('id_aviario', $idaviario)->get();
        foreach ($aviarios as $aviario){
            return $aviario->aviario;
        }
    } //
}
