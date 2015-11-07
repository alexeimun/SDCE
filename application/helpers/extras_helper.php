<?php

    /**
     * @param array $params
     * @return string
     */
    function Table(array $params)
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
        $actions = isset($actions) ? $actions : '';
        $controller = isset($controller) ? $controller : '';
        $autoNumeric = isset($autoNumeric) ? $autoNumeric : false;

        $view = strrchr($actions, 'v');
        $update = strrchr($actions, 'u');
        $delete = strrchr($actions, 'd');
        $print = strrchr($actions, 'p');
        $check = strrchr($actions, 'c');
        $radio = strrchr($actions, 'r');

        $action = $delete || $update || $view || $print || $check || $radio;

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
        if($action)
        {
            $table .= '<th style="">Acciones</th>';
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
                    //var_dump($data[$value]);exit;
                    $table .= '<td>' . $data[$value] . '</td>';
                }
            }

            if($action)
            {
                $table .= '<td>';

                $kview = $controller . '/ver' . $tableName;
                $kupdate = $controller . '/actualizar' . $tableName;
                $kprint = $controller . '/imprimir' . $tableName;
                $keys = '';

                if(is_array($id))
                {
                    foreach ($id as $ikey => $ids)
                    {
                        if(!is_numeric($ids))
                        {
                            $keys .= '/' . $data[$ids];
                        }
                        else
                        {
                            $keys .= '/' . $ids;
                        }
                    }
                }
                else
                {
                    $keys .= '/' . $data[$id];
                }
                //var_dump($keys);exit;

                if($view)
                {
                    $table .= '<a href="' . site_url($kview . $keys) . '" style="font-size:20pt;color:  #29a84b" class="ion ion-ios-paper" target="_blank" data-toggle="tooltip" title="Ver m&aacute;s..."></a>&nbsp;&nbsp;';
                }
                if($print)
                {
                    $table .= '<a href="' . site_url($kprint . $keys) . '" style="font-size:20pt;color: black" target="_blank" class="fa fa-print" data-toggle="tooltip" title="Imprimir"></a>&nbsp;&nbsp;';
                }
                if($update)
                {
                    $table .= '<a href="' . site_url($kupdate . $keys) . '"  target="_blank" style="font-size:20pt;color:  #0065c3" class="ion ion-edit" data-toggle="tooltip" title="Editar"></a>&nbsp;&nbsp;';
                }
                if($delete)
                {
                    $table .= " <a data-id='$data[$id]' style='color:#e54040;font-size:20pt;' class='fa fa-trash-o' data-toggle='tooltip' title='Eliminar'></a>";
                }
                ###Check###
                if($check)
                {
                    $table .= "<input type='checkbox' value='" . $data[$id] . "' checked>";
                }
                ###Radio###
                if($radio)
                {
                    $table .= "<input type='radio' name='RADIO' value='" . $data[$id] . "' checked>";
                }
                $table .= '</td>';
            }
            $table .= '</tr>';
        }
        $table .= '</tbody></table>';

        return $table;
    }

    /**
     * @param array $params
     * @return string
     */
    function Dropdown(array $params)
    {
        extract($params);
        /**
         * @var array $dataProvider
         * @var string $name
         * @var string $placeholder
         * @var string $width
         * @var string $fields
         * @var string $index
         * @var bool $readonly
         * @var bool $simple
         */

        $frag = isset($simple) && $simple ? '' : '';
        $disable = '';
        $size = isset($width) ? $width : '100%';
        if(isset($readonly))
        {
            $frag = '';
            $disable = "disabled";
            $size = '100%';
        }
        $dropdown = "<select  name='$name' class='form-control $frag' $disable style='width:" . $size . ";'>";
        $dropdown .= "<option style='text-align: center;' value='0'>$placeholder</option>";
        $name = preg_replace('/\[|\]/', '', $name);
        foreach ($dataProvider as $data)
        {
            if(isset($index) && $index == $data[$name])
            {
                $dropdown .= "<option value='$data[$name]' selected>";
            }
            else
            {
                $dropdown .= "<option value='$data[$name]'>";
            }

            foreach ($fields as $key => $value)
            {
                if(!is_numeric($key))
                {
                    $dropdown .= $value;
                }
                else
                {
                    $dropdown .= $data[$value];
                }
            }
            $dropdown .= '</option>';
        }
        $dropdown .= '</select>';
        return $dropdown;
    }

    function Question($params = [])
    {
        /**
         * @var string $question
         * @var array $options
         * @var array $num
         * @var array $name
         * @var bool $opcional
         * @var bool $checked
         * @var bool $slider
         */
        extract($params);
        $opcional = isset($opcional) && $opcional ? 'opcional' : '';
        $checked = isset($checked) ? $checked = 'checked' : '';
        $num = isset($num) ? $num . '.' : '';

        $template = "<div id='st" . $name . "'><table class='statement'>
            <div class='font1' style='text-align: left;'>$num <span >$question</span>";

        $template .= '</div>';
        $opt = 0;
        $literals = ['a', 'b', 'c', 'd', 'e', 'f'];
        foreach ($options as $option)
        {
            $template .= "<tr>
                <td><input type='radio' class='$opcional' value='$literals[$opt]' name='R$name' $checked> </td>
                <td class='option font2' style='text-align: justify;'>" . $literals[$opt] . ")  $option </td>
            </tr>";
            $opt++;
        }
        $template .= "</table></div><br>";
        if(isset($slider) && $slider)
        {
            $template .= '<div class="row margin">
                <div class="col-sm-6">
            <input id="range' . $name . '" type="text" name="range[]" >
        </div></div>';
        }
        return $template;
    }

    function Stringify($string)
    {

    }

    function Alert($params)
    {
        extract($params);

        /**
         * @var $title
         * @var $text
         * @var $icon
         * @var $type
         */

        $type = isset($type) ? $type : 'success';
        $text = isset($text) ? $text : '';
        $icon = isset($icon) ? $icon : 'ion-checkmark';
        return "<div class='alert alert-$type'>
              	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              	<span class='$icon' style='font-size: 20pt'> </span><strong>$title</strong> $text
              </div>";
    }

    function Beginbox($params)
    {
        extract($params);

        /**
         * @var $title
         * @var $text
         * @var $type
         * @var $color
         * @var $localStorage
         */
        $color = isset($color) ? $color : 'green';
        $Alert = "<div class='row'>
                        <div class='col-lg-9'>
                            <div class='box box-solid bg-$color-gradient'>
                                <div class='box-header'>
                                    <i class='fa fa-th'></i>
                                    <h3 class='box-title'>$title</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn bg-$color btn-sm' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn bg-$color btn-sm' data-widget='remove'><i class='fa fa-times'></i></button>
                                    </div>
                                </div>
                                <div class='box-body border-radius-none'>";
        echo $Alert;
    }

    function Endbox()
    {
        return " </div><!-- /.box-body -->
                                <div class='box-footer no-border'>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div>
                    </div>";
    }

    function Uncamelize($string)
    {
        $string = pathinfo($string)['filename'];
        $new = '';
        for ($i = 0; $i < strlen($string); $i++)
        {
            if(ctype_upper($string[$i]))
            {
                $new .= ' ' . $string[$i];
            }
            else
            {
                $new .= $string[$i];
            }
        }
        return $new;
    }

    function br($n = 1)
    {
        for ($i = 0; $i < $n; $i++)
        {
            echo '<br>';
        }
    }

    function Telefono($tel)
    {
        if(strlen($tel) == 7)
        {
            return substr($tel, 0, 3) . ' ' . substr($tel, 3, 2) . ' ' . substr($tel, 5, strlen($tel));
        }
        else if(strlen($tel) == 10)
        {
            return substr($tel, 0, 3) . ' ' . substr($tel, 3, 3) . ' ' . substr($tel, 6, 2) . ' ' . substr($tel, 8, strlen($tel));
        }
        else
        {
            return $tel;
        }
    }

    function Ucspecial($txt)
    {
        $txt = str_replace('á', 'Á', $txt);
        $txt = str_replace('é', 'É', $txt);
        $txt = str_replace('í', 'Í', $txt);
        $txt = str_replace('ó', 'Ó', $txt);
        $txt = str_replace('ú', 'Ú', $txt);
        $txt = str_replace('ñ', 'Ñ', $txt);
        return strtoupper($txt);
    }

    function CleanSql(&$value)
    {
        if(is_array($value))
        {
            foreach ($value as $key => $val)
            {
                $value[$key] = str_replace('"', '', str_replace("'", '', str_replace("\\", '', str_replace("#", '', $val))));
            }
        }
        else
        {
            return str_replace('"', '', str_replace("'", '', str_replace("\\", '', str_replace("#", '', $value))));
        }
    }