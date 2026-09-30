<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan baris ini

class Mutasi extends Model
{
    use SoftDeletes; // Tambahkan baris ini
}