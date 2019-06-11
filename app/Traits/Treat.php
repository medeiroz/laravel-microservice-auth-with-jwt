<?php


namespace App\Traits;


trait Treat
{
    public function scopeTreat($query, array $columns = [])
    {

        if(count($columns)){

            //Define os campos nos quais pode ser realizado as operações
            $fillable = array_merge($this->fillable, ['created_at', 'updated_at', 'id']);

            /**
             * Seleção dos campos
             */
            if(isset($columns['fields'])){

                $fieldsOfSelect = explode(',', $columns['fields']);

                //Verifica se os campos passados existem na tabela
                $intersectionSelect = array_intersect($fillable, $fieldsOfSelect);

                if(count($intersectionSelect))
                    $query->select($intersectionSelect);

            }


            /**
             * Filtragem
             */
            //Verifica quais campos existem na tabela e foram informados
            $intersectionSearch = array_intersect($fillable, array_keys($columns));

            foreach($intersectionSearch as $value){

                if(!empty($columns[$value]))
                    $query->where($value,'like',"%{$columns[$value]}%");

            }

            /**
             * Ordenação
             */
            if(isset($columns['sort'])){

                $orderColumns = explode(',', $columns['sort']);

                foreach ($orderColumns as $value){

                    //Verifica a ordem os campos
                    if(substr($value,0,1) == '-'){
                        $orderBy = 'desc';
                        $columnBy = substr($value,1);
                    }else{
                        $orderBy = 'asc';
                        $columnBy = $value;
                    }

                    //Caso a coluna exista na tabela, então orderna
                    if(in_array($columnBy, $fillable))
                        $query->orderBy($columnBy, $orderBy);


                }

            }



        }
        return $query;
    }
}
