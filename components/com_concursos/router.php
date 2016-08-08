<?php

class ConcursosRouter extends JComponentRouterBase{
    public function build(&$query) {
         $segments = array();
         //echo "<pre>"; print_r($query); exit();
       if (isset($query['view']))
       {
                $segments[] = $query['view'];
                unset($query['view']);
       }
       if (isset($query['id']))
       {
                $segments[] = $query['id'];
                unset($query['id']);
       }
      
       return $segments;
    }

    public function parse(&$segments) {
        $vars = array();
        //echo "<pre>"; print_r($segments); exit();
       switch($segments[0])
       {
               case 'concursos':
                       $vars['view'] = 'concursos';
                       break;
               case 'concurso':
                       $vars['view'] = 'concurso';
                       $id = explode(':', $segments[1]);
                       $vars['id'] = (int) $id[0];
                       break;
               
       }
       return $vars;
    }

}

