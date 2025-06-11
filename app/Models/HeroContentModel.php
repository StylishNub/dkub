<?php

namespace App\Models;
use CodeIgniter\Model;

class HeroContentModel extends Model
{
    protected $table = 'hero_content';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'hero_title', 'hero_description', 'hero_image'];
    protected $useTimestamps = false;

    protected $returnType = 'array';
}
