<?php

namespace RaportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    private $output;
    private $countries;

    public function __construct() {
        $this->output = '';
        $this->countries = '';
    }

    public function indexAction() {
        return $this->render('RaportBundle:Default:index.html.twig');
    }

    public function helloAction() {

        $this->output[] = <<<HTML
         <html>
                 <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
                 </head>
                 <body>
                        <table class="table table-striped">
                            <tr>
                                 <th><center>Raport z testowania response 200</center></th>
                            </tr>
                            <tr>
                                 <td>Lp.</td>
                                 <td>Link</td>
                                 <td>Status</td>
                            </tr>
HTML;

        $this->writeIntoFile();
        return new Response('response');
    }

    public function writeIntoFile() {
        
        $this->countries = [
            ['alaska'], ['alabama'], ['new york'], ['texas']
        ];
            $j = 1;
        for($i = 0; $i <count($this->countries);++$i){
        
            $name = implode("|",$this->countries[$i]);
            $this->output[] = '<tr><td>'.$j.'</td><td>'.$name.'</td><td>Response 200 ok</td></tr>';
            $j++;
         
        }
        $this->output[] = <<<HTML
                    </table>
                </body>
                            </html>
                
HTML;
        $fs = new \Symfony\Component\Filesystem\Filesystem();
        $fs->dumpFile('C:\xampp\htdocs\raport\src\RaportBundle\Resources\views\Default\result.html', $this->output);
    }

}
