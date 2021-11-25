<?php

namespace controllers;

use controllers\base\Web;
use Dompdf\Dompdf;
require_once '.idea/dompdf/autoload.inc.php';

class genpdf extends Web
{
    public $dompdf;
    $dompdf = new Dompdf();
}