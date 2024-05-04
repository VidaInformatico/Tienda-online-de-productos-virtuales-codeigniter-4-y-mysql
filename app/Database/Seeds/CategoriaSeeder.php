<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategoriaSeeder extends Seeder
{


    public function run()
    {
        // Ruta de la carpeta "productos"
        $categoriasFolder = ROOTPATH . 'public/img/categorias';

        // Verificar si la carpeta existe, si no, créala
        if (!is_dir($categoriasFolder)) {
            mkdir($categoriasFolder, 0777, true);
        }

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $titulo = implode(' ', $faker->words(2));
            $data = [
                'nombre' => $titulo,
                'slug' => $this->createSlug($titulo),
                'imagen' => $faker->imageUrl(),
            ];

            // Descargar la imagen y obtener su contenido
            $imagenContenido = file_get_contents($data['imagen']);

            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . '.jpg';

            $rutaImagen = $categoriasFolder . '/' . $nombreImagen;

            // Guardar la imagen localmente
            write_file($rutaImagen, $imagenContenido);

            // Actualizar la información en la base de datos con la ruta local de la imagen
            $data['imagen'] = 'categorias/' . $nombreImagen;
            $this->db->table('categorias')->insert($data);
        }
    }

    private function createSlug($text)
    {
        // Reemplazar caracteres especiales y espacios con guiones
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $slug;
    }
}
