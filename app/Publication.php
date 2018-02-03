<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use Searchable;

    public function toSearchableArray(){
      $array =  $this->toArray();

      $attributes = array("title",//titolo della pubblicazione
                    "venue",//rivista di pubblicazione
                    "volume",//volume della rivista
                    "number",//numero della rivista
                    "pages",//pagine della rivista
                    "year",//anno di pubblicazione
                    "type",//tipo di pubblicazione
                    "key",//The key can also be found as the "key" attribute of the record in the record's XML export.(dal faq di dblp)
                    "doi",// id identificativo della pubblicazione (http://dblp.uni-trier.de/doi/)
                    "ee",// Link alla risorsa (pdf o sito su cui comprare il pdf)
                    "url");// Link alla pagina di dblp


      $newArray = array();

      foreach ($attributes as $attribute) {
        array_push($newArray,$array[$attribute]);
      }

      return $newArray;
    }

}
