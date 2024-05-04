<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
class ProductoSeeder extends Seeder
{
    public function run()
    {
        // Ruta de la carpeta "productos"
        $productosFolder = ROOTPATH . 'public/img/productos';

        // Verificar si la carpeta existe, si no, créala
        if (!is_dir($productosFolder)) {
            mkdir($productosFolder, 0777, true);
        }

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $titulo = $faker->sentence;

            $data = [
                'codigo' => $faker->unique()->ean8,
                'titulo' => $titulo,
                'slug' => $this->createSlug($titulo),
                'descripcion' => $faker->paragraph,
                'precio_normal' => $faker->randomFloat(2, 10, 100),
                'precio_rebajado' => $faker->randomFloat(2, 5, 90),
                'imagen' => $faker->imageUrl(),
                'id_categoria' => $faker->numberBetween(1, 5)
            ];

            // Descargar la imagen y obtener su contenido
            $imagenContenido = file_get_contents($data['imagen']);

            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . '.jpg';

            // Ruta completa de la imagen
            $rutaImagen = $productosFolder . '/' . $nombreImagen;

            // Guardar la imagen localmente
            write_file($rutaImagen, $imagenContenido);

            // Actualizar la información en la base de datos con la ruta local de la imagen
            $data['imagen'] = 'productos/' . $nombreImagen;

            $this->db->table('productos')->insert($data);
        }
    }

    private function createSlug($text)
    {
        // Reemplazar caracteres especiales y espacios con guiones
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $text), '-'));
        return $slug;
    }
}
