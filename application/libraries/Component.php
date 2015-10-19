<?php

    class Component
    {
        public static function Sidebar($params)
        {
            extract($params['options']);
            /**
             * @var string $header
             * @var string $img
             */
            ##Header######################################################################
            $sidebar = "<aside class='main-sidebar'>
                <!-- sidebar: style can be found in sidebar.less -->
                <section class='sidebar'>
                    <!-- Sidebar user panel -->
                    <div class='user-panel'>
                        <div class='pull-left'>";
            if(isset($img))
            {
                $img['url'] = isset($img['url']) ? "onclick=" . "\"" . "location.href='" . site_url($img['url']) . "'" . "\"" : '';
                $sidebar .= "<img  src='" . base_url() . '/' . $img['path'] . "' " . $img['url'] . " draggable='false' style='cursor: pointer' class='img-responsive'/>";
            }
            $sidebar .= "</div>
                                    </div>
                                    <!-- sidebar menu: : style can be found in sidebar.less -->
                                    <ul class='sidebar-menu'>
                                        <li class='header'><span style='color:#6b6b6b;'>$header</span></li>";
            ##Items########################################################################
            $sidebar .= self::renderItems($params['items'], false);
            return $sidebar . "</ul></section></aside>";
        }

        private static function renderItems($items, $auto)
        {
            $sidebar = '';
            foreach ($items as $item)
            {
                if(isset($item['visible']) && !$item['visible'])
                {
                    continue;
                }
                $item['options']['target'] = isset($item['options']['target']) ? 'target="' . $item['options']['target'] . '"' : '';
                $item['options']['icon'] = isset($item['options']['icon']) ? $item['options']['icon'] : '';
                $id = "id='" . strtolower(str_replace(' ', '', $item['label'])) . "'";

                if(isset($item['items']))
                {
                    $sidebar .= "<li $id class='treeview'>
                                    <a href='" . (isset($item['url']) ? site_url($item['url']) : '#') . "'>
                                    <i class='" . $item['options']['icon'] . "'></i> <span>&nbsp;&nbsp;" . $item['label'] . "</span>
                                        <i class='fa fa-angle-left pull-right'></i>
                                    </a>
                                    <ul class='treeview-menu'><li>" . static::renderItems($item['items'], true) . "</li></ul></li>";
                }
                else
                {
                    if($auto)
                    {
                        $sidebar .= "<li><a href='" . (isset($item['url']) ? site_url($item['url']) : '#') . "' " . $item['options']['target'] . "'>
                        <i class='fa " . $item['options']['icon'] . "'></i> " . $item['label'] . "</a></li>";
                    }
                    else
                    {
                        $sidebar .= "<li $id class='treeview'>
                        <a href='" . (isset($item['url']) ? site_url($item['url']) : '#') . "' " . $item['options']['target'] . ">
                        <i class='" . $item['options']['icon'] . "'></i> <span>&nbsp;&nbsp;" . $item['label'] . "</span>
                        </a></li>";
                    }
                }
            }
            return $sidebar;
        }

        public static function Table(array $params)
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
                                #Represents a phone number
                                case 'phone':
                                    $table .= '<td>' . Telefono($data[$key]) . '</td>';
                                    break;
                                #Periodo académico (Campo particular)
                                case 'periodo':
                                    $table .= '<td>' . date('Y-', strtotime($data[$key])) . (date('m', strtotime($data[$key])) > 6 ? 2 : 1) . '</td>';
                                    break;
                            }
                        }
                    }
                    else
                    {
                        $table .= '<td>' . ($data[$value] = strlen($data[$value]) > 40 ? substr($data[$value], 0, 40) . '...' : $data[$value]) . '</td>';
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
                        $table .= '<a href="' . site_url($kprint . $keys) . '" style="font-size:20pt;color: black" target="_blank" class="ion ion-android-print" data-toggle="tooltip" title="Imprimir"></a>&nbsp;&nbsp;';
                    }
                    if($update)
                    {
                        $table .= '<a href="' . site_url($kupdate . $keys) . '"  target="_blank" style="font-size:20pt;color:  #0065c3" class="ion ion-edit" data-toggle="tooltip" title="Editar"></a>&nbsp;&nbsp;';
                    }
                    if($delete)
                    {
                        $table .= " <a data-id='$data[$id]' style='color:#e54040;font-size:20pt;' class='ion ion-trash-b' data-toggle='tooltip' title='Eliminar'></a>";
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

        public static function UserTable(array $params)
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
             * @var string $nivel
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
                $back = $data['NIVEL'] == 2 ? "style='background: rgba(0, 0, 255, 0.11)'" : '';
                $table .= "<tr $back>";
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
                                #Represents a phone number
                                case 'phone':
                                    $table .= '<td>' . Telefono($data[$key]) . '</td>';
                                    break;
                                #Periodo académico (Campo particular)
                                case 'periodo':
                                    $table .= '<td>' . date('Y-', strtotime($data[$key])) . (date('m', strtotime($data[$key])) > 6 ? 2 : 1) . '</td>';
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
                        $table .= '<a href="' . site_url($kprint . $keys) . '" style="font-size:20pt;color: black" target="_blank" class="ion ion-android-print" data-toggle="tooltip" title="Imprimir"></a>&nbsp;&nbsp;';
                    }
                    if($update && ($data['NIVEL'] != 2 || $nivel))
                    {
                        $table .= '<a href="' . site_url($kupdate . $keys) . '"  target="_blank" style="font-size:20pt;color:  #0065c3" class="ion ion-edit" data-toggle="tooltip" title="Editar"></a>&nbsp;&nbsp;';
                    }
                    if($delete && $nivel && $data['NIVEL'] != 2)
                    {
                        $table .= " <a data-id='$data[$id]' style='color:#e54040;font-size:20pt;' class='ion ion-trash-b' data-toggle='tooltip' title='Eliminar'></a>";
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

        public static function Dropdown(array $params)
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

        public static function Question($params = [])
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

        public static function Alert($params)
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

        public static function Beginbox($params)
        {
            extract($params);

            /**
             * @var $title
             * @var $text
             * @var $type
             */
            return "<div class='row'>
                        <div class='col-lg-9'>
                            <div class='box box-solid bg-green-gradient'>
                                <div class='box-header'>
                                    <i class='fa fa-th'></i>
                                    <h3 class='box-title'>$title</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn bg-green btn-sm' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn bg-green btn-sm' data-widget='remove'><i class='fa fa-times'></i></button>
                                    </div>
                                </div>
                                <div class='box-body border-radius-none'>";
        }

        public static function Endbox()
        {
            return " </div><!-- /.box-body -->
                                <div class='box-footer no-border'>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div>
                    </div>";
        }
    }