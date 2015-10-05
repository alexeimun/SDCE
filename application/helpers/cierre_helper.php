<?php

    /**
     * @param array $params
     * @return string
     */
    function TablaCierre(array $params)
    {
        extract($params);
        /**
         * @var array $columns
         * @var array $fields
         * @var array $dataProvider
         * @var string $actions
         * @var string $align
         * @var string $tableName
         * @var bool $autoNumeric
         * @var string $id
         * @var string $controller
         */

        $align = isset($align) ? $align : 'left';
        $autoNumeric=isset($autoNumeric)?$autoNumeric:false;
        $table = '<table id="tabla" style="text-align:' . $align . '" data-name="' . $tableName . '" class="table table-bordered table-striped"><thead><tr>';
        if($autoNumeric)
        {
            $c = 0;
            $table .= '<th style="width: 20px;">#</th>';
        }
        foreach ($columns as $columnName => $value)
        {
            if(!is_numeric($columnName))
            {
                $table .= '<th style="' . (isset($value['style']) ? $value['style'] : '') . ';text-align:' . $align . '">' . $columnName . '</th>';
            }
            else
            {
                $table .= '<th style="text-align:' . $align . '">' . $value . '</th>';
            }
        }
        $table .= '</tr></thead><tbody>';

        foreach ($dataProvider as $data)
        {
            $table .= '<tr>';
            if($autoNumeric)
            {
                $table .= '<td>' . (++$c) . '</td>';
            }
            foreach ($fields as $key => $value)
            {
                if(!is_numeric($key))
                {
                    if(is_array($value))
                    {
                        switch ($value['type'])
                        {
                            case 'img':
                                #Represents a image
                                $table .= '<td><img class="img-circle" style="height: 25px;width: 25px;" src="' . $value['path'] . '/' . $data[$key] . '"></td>';
                                break;
                        }
                    }
                    else
                    {
                        switch ($value)
                        {
                            #Represents a moment helper
                            case 'moment':
                                $table .= '<td>' . Momento($data[$key]) . '</td>';
                                break;
                            #Represents a date with the helper
                            case 'date':
                                $table .= '<td>' . date_format(new DateTime($data[$key]), 'd/m/Y') . '</td>';
                                break;
                            #Represents a number format
                            case 'numeric':
                                $table .= '<td>' . number_format($data[$key], 0, '', ',') . '</td>';
                                break;
                        }
                    }
                }
                else
                {
                    if($value == 'CHECKBOX')
                    {
                        $table .= '<td><input type="checkbox"></td>';
                    }
                    else
                    {
                        $table .= '<td>' . $data[$value] . '</td>';
                    }
                }
            }

            $table .= '</tr>';
        }
        $table .= '</tbody></table>';

        return $table;
    }
