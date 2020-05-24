<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lote;

class Ave extends Model
{
    protected $primaryKey = 'id_ave';
    public  $incrementing = false;
    protected $fillable = [
        'id_ave',
        'id_aviario',
        'data_ave',
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
        return Ave::where('lote_id', $search)->orderBy('id_ave', 'desc')->first();
    }

    public function valLote($idlote) {
        return Lote::where('id_lote', $idlote)->get();
    }

    public function lastave() {
        $lastave = Ave::orderBy('id_ave', 'desc')->get();

        if ($lastave->count() > 0):
            foreach ($lastave as $last):
                return $last->id_ave + 1;
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
    }
}
