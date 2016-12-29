<?php

class NotimpRouter extends JComponentRouterBase {

    public function build(&$query) {
        $segments = array();
       
        if (isset($query['view'])) {
            $segments[] = $query['view'];
            unset($query['view']);
        }
        if (isset($query['id'])) {
            $segments[] = $query['id'];
            unset($query['id']);
        }

        return $segments;
    }

    public function parse(&$segments) {
        $vars = array();
       
        switch ($segments[0]) {
            case 'notimps':
                $vars['view'] = 'notimps';
                if (isset($segments[1])):
                    $ano = explode(':', $segments[1]);
                    $vars['ano'] = (int) $ano[0];
                endif;
                break;
            case 'notimp':
                $vars['view'] = 'notimp';
                if (isset($segments[1])):
                    $id = explode(':', $segments[1]);
                    $vars['id'] = (int) $id[0];
                endif;
                break;
        }
        return $vars;
    }

}
