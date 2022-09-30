<?php


namespace Vxsoft\Main\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class MainTwigExtension extends AbstractExtension
{
    function getFunctions()
    {
        return [
            new TwigFunction('render_header_list', [$this, 'renderHeaderList'], ['is_safe' => ['html']]),
            new TwigFunction('render_sidebar_link', [$this, 'renderSidebarLink'], ['is_safe' => ['html']]),
            new TwigFunction('render_save_button', [$this, 'renderSaveBtn'], ['is_safe' => ['html']]),
            new TwigFunction('render_action_button', [$this, 'renderActionBtn'], ['is_safe' => ['html']]),


        ];
    }

   public function renderHeaderList($url, $title, $iconClass){
        return ' <li class="nav-item">
                                    <a class="nav-link btn btn-primary" href="'.$url.'"><i class="'.$iconClass.'"></i> ' .$title.'</a>
                                </li>';
    }
    public function renderActionBtn($url,$title, $iconClass, $btnColor){
       return '<li><a class="'.$btnColor.'" href="'.$url.'"><i class="'.$iconClass.'"></i> '.$title.'</a></li>';
    }

    public function renderSidebarLink($route= '', $title = '',  $class = '',$icon = ''){
       return sprintf('<li class="nav-item">
                   <a class="nav-link" href="%s">%s</a>
                </li>',$route,$title);
    }

    public function renderSaveBtn(){
        return '  <div class="form-group">
                        <button type="submit" class="btn btn-primary"> <i class=" fa fa-save"></i> Save</button>
                    </div>';
    }

}