<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        // Ruta de la carpeta "productos"
        $sliderFolder = ROOTPATH . 'public/img/sliders';

        // Verificar si la carpeta existe, si no, créala
        if (!is_dir($sliderFolder)) {
            mkdir($sliderFolder, 0777, true);
        }

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $titulo = implode(' ', $faker->words(2));
            $data = [
                'titulo' => $titulo,
                'subtitulo' => implode(' ', $faker->words(3)),
                'descripcion' => implode(' ', $faker->words(5)),
                'slug' => $this->createSlug($titulo),
                'imagen' => $faker->imageUrl(1000, 500),
            ];

            // Descargar la imagen y obtener su contenido
            $imagenContenido = file_get_contents($data['imagen']);

            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . '.jpg';

            $rutaImagen = $sliderFolder . '/' . $nombreImagen;

            // Guardar la imagen localmente
            write_file($rutaImagen, $imagenContenido);

            // Actualizar la información en la base de datos con la ruta local de la imagen
            $data['imagen'] = 'sliders/' . $nombreImagen;
            $this->db->table('sliders')->insert($data);
        }
    }

    private function createSlug($text)
    {
        // Reemplazar caracteres especiales y espacios con guiones
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $slug;
    }
}
