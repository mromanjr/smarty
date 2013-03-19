<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Classe Sitemap
 * and open the template in the editor.
 */

class Sitemap extends CI_Model{
    
    public function __construct() {
        
        $result = $this->db->get("conteudos")->result();
        foreach ($result as $row) {                
            echo $row->titulo;
        }
    }
}
?>
