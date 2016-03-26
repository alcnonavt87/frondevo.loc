<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Imagick
 */

Class Imagick extends Model
{


    public function getСropedImg($newWidth, $newHeight, $image)
    {
        // Опрделяем размеры изображения
        $imageGeometry = $image->getImageGeometry();

        // Подсчитываем соотношение сторон изображения
        $ratio = $imageGeometry['width'] / $imageGeometry['height'];

        // Соотношение сторон нужных размеров
        $newRatio = $newWidth / $newHeight;

        // Размеры, до которых обрежем картинку до масштабирования
        $cropWidth = $imageGeometry['width'];
        $cropHeight = $imageGeometry['height'];
        // Смотрим соотношения
        if($ratio > $newRatio) {
            // Если ширина картинки слишком большая для пропорции,
            // то будем обрезать по ширине
            $cropWidth = round($newRatio * $cropHeight);
        } else {
            // Либо наоборот, если высота картинки слишком большая для пропорции,
            // то обрезать будем по высоте
            $cropHeight = round($cropWidth / $newRatio);
        }
        // Обрезаем по высчитанным размерам до нужной пропорции
        $x = floor(($imageGeometry['width'] - $cropWidth)/2);
        $y = floor(($imageGeometry['height'] - $cropHeight)/2);

        $image->cropImage($cropWidth, $cropHeight, $x , $y);
        // Масштабируем картинку то точных размеров

        return true;
    }

    public function getNewHeightImg($newWidth, $image)
    {
        // Опрделяем размеры изображения
        $imageGeometry = $image->getImageGeometry();

        //Определяем новую высоту
        $newHeight = round($newWidth * $imageGeometry['height'] / $imageGeometry['width']);

        return $newHeight;
    }

    public function getNewWidthImg($newHeight, $image)
    {
        // Опрделяем размеры изображения
        $imageGeometry = $image->getImageGeometry();

        //Определяем новую ширину
        $newWidth = round($newHeight * $imageGeometry['width'] / $imageGeometry['height']);

        return $newWidth;
    }

    public function makeResizeImage($w, $h, $newFileName, $tmpFileName, $format, $filter, $blur, $radius, $sigma, $compressionType, $compression)
    {
        /**
         * Создаём уменьшенное изображение
         *
         * @param int $w - новая ширина изображения
         * @param int $h - новая высота изображения
         * @param string $newFileName - новое имя файла
         * @param string $tmpFileName - времменое имя файла
         * @param string $format - формат изображения
         * @param int $filter - константа фильтра imagick::FILTER_ХХХ
         * @param real $blur - значение размытия (The blur factor where > 1 is blurry, < 1 is sharp.)
         * @param int $radius - радиус Гауса для резкости
         * @param int $sigma - стандартное отклонение для резкости
         * @param int $compressionType - тип компресии, константа COMPRESSION_ХХХ
         * @param int $compression - значение компресии 1-100
         *
         * @return bool - TRUE
         */

        //Создаём новый объект
        $image = new \Imagick($tmpFileName);
        //Изменяем размер изображения
        $image->resizeImage($w, $h, $filter, $blur, false);
        //Применяем функцию функцию резкости
        $image->sharpenImage($radius, $sigma);
        //Устанавливаем формат изображения согласно mime типу
        $image->setImageFormat($format);
        //Устанавливаем тип компресии перед сохранением
        $image->setImageCompression($compressionType);
        //Устанавливаем качество
        $image->setImageCompressionQuality($compression);
        //Сохраняем изображение
        $image->writeImage($newFileName);
        //Уничтожаем объект
        $image->destroy();

        return true;
    }

    public function makeResizeImageWithOptimalCrop($w, $h, $newFileName, $tmpFileName, $format, $filter, $blur, $radius, $sigma, $compressionType, $compression)
    {
        /**
         * Создаём уменьшенное изображение с оптимальным обризанием оригинального изображения для соблюдения пропорции
         *
         * @param int $w - новая ширина изображения
         * @param int $h - новая высота изображения
         * @param string $newFileName - новое имя файла
         * @param string $tmpFileName - времменое имя файла
         * @param string $format - формат изображения
         * @param int $filter - константа фильтра imagick::FILTER_ХХХ
         * @param real $blur - значение размытия (The blur factor where > 1 is blurry, < 1 is sharp.)
         * @param int $radius - радиус Гауса для резкости
         * @param int $sigma - стандартное отклонение для резкости
         * @param int $compressionType - тип компресии, константа COMPRESSION_ХХХ
         * @param int $compression - значение компресии 1-100
         *
         * @return bool - TRUE
         */

        //Создаём новый объект
        $image = new \Imagick($tmpFileName);
        //Обрезаем его до пропорциональных размеров
        $this->getСropedImg($w, $h, $image);
        //Изменяем размер изображения
        $image->resizeImage($w, $h, $filter, $blur, false);
        //Применяем функцию функцию резкости
        $image->sharpenImage($radius, $sigma);
        //Устанавливаем формат изображения согласно mime типу
        $image->setImageFormat($format);
        //Устанавливаем тип компресии перед сохранением
        $image->setImageCompression($compressionType);
        //Устанавливаем качество
        $image->setImageCompressionQuality($compression);
        //Сохраняем изображение
        $image->writeImage($newFileName);
        //Уничтожаем объект
        $image->destroy();

        return true;
    }

    public function makeResizeImageByWidth($w, $newFileName, $tmpFileName, $format, $filter, $blur, $radius, $sigma, $compressionType, $compression)
    {
        /**
         * Создаём уменьшенное изображение с оптимальной высотой, которая определяется на основании заданой новой ширины
         *
         * @param int $w - новая ширина изображения
         * @param string $newFileName - новое имя файла
         * @param string $tmpFileName - времменое имя файла
         * @param string $format - формат изображения
         * @param int $filter - константа фильтра imagick::FILTER_ХХХ
         * @param real $blur - значение размытия (The blur factor where > 1 is blurry, < 1 is sharp.)
         * @param int $radius - радиус Гауса для резкости
         * @param int $sigma - стандартное отклонение для резкости
         * @param int $compressionType - тип компресии, константа COMPRESSION_ХХХ
         * @param int $compression - значение компресии 1-100
         *
         * @return int - новая высота изображения
         */

        //Создаём новый объект
        $image = new \Imagick($tmpFileName);
        //Определяем оптимальную высоту согласно пропорции
        $h = $this->getNewHeightImg($w, $image);
        //Изменяем размер изображения
        $image->resizeImage($w, $h, $filter, $blur, false);
        //Применяем функцию функцию резкости
        $image->sharpenImage($radius, $sigma);
        //Устанавливаем формат изображения согласно mime типу
        $image->setImageFormat($format);
        //Устанавливаем тип компресии перед сохранением
        $image->setImageCompression($compressionType);
        //Устанавливаем качество
        $image->setImageCompressionQuality($compression);
        //Сохраняем изображение
        $image->writeImage($newFileName);
        //Уничтожаем объект
        $image->destroy();

        return $h;
    }

    public function makeResizeImageByHeight($h, $newFileName, $tmpFileName, $format, $filter, $blur, $radius, $sigma, $compressionType, $compression)
    {
        /**
         * Создаём уменьшенное изображение с оптимальной шириной, которая определяется на основании заданой новой высоты
         *
         * @param int $h - новая ширина изображения
         * @param string $newFileName - новое имя файла
         * @param string $tmpFileName - времменое имя файла
         * @param string $format - формат изображения
         * @param int $filter - константа фильтра imagick::FILTER_ХХХ
         * @param real $blur - значение размытия (The blur factor where > 1 is blurry, < 1 is sharp.)
         * @param int $radius - радиус Гауса для резкости
         * @param int $sigma - стандартное отклонение для резкости
         * @param int $compressionType - тип компресии, константа COMPRESSION_ХХХ
         * @param int $compression - значение компресии 1-100
         *
         * @return int - новая ширина изображения
         */

        //Создаём новый объект
        $image = new \Imagick($tmpFileName);
        //Определяем оптимальную ширину согласно пропорции
        $w = $this->getNewWidthImg($h, $image);
        //Изменяем размер изображения
        $image->resizeImage($w, $h, $filter, $blur, false);
        //Применяем функцию функцию резкости
        $image->sharpenImage($radius, $sigma);
        //Устанавливаем формат изображения согласно mime типу
        $image->setImageFormat($format);
        //Устанавливаем тип компресии перед сохранением
        $image->setImageCompression($compressionType);
        //Устанавливаем качество
        $image->setImageCompressionQuality($compression);
        //Сохраняем изображение
        $image->writeImage($newFileName);
        //Уничтожаем объект
        $image->destroy();

        return $w;
    }

    public function makeResizeImageByMinSide($w, $h, $newFileName, $tmpFileName, $format, $filter, $blur, $radius, $sigma, $compressionType, $compression)
    {
        /**
         * Создаём уменьшенное изображение с масштабированием оригинального по меньшей стороне
         *
         * @param int $w - новая ширина изображения
         * @param int $h - новая высота изображения
         * @param string $newFileName - новое имя файла
         * @param string $tmpFileName - времменое имя файла
         * @param string $format - формат изображения
         * @param int $filter - константа фильтра imagick::FILTER_ХХХ
         * @param real $blur - значение размытия (The blur factor where > 1 is blurry, < 1 is sharp.)
         * @param int $radius - радиус Гауса для резкости
         * @param int $sigma - стандартное отклонение для резкости
         * @param int $compressionType - тип компресии, константа COMPRESSION_ХХХ
         * @param int $compression - значение компресии 1-100
         *
         * @return bool - TRUE
         */

        //Создаём новый объект
        $image = new \Imagick($tmpFileName);
		//Получаем новую размерность изображения "по меньшей стороне"
        $geometryToMin = $this->getGeometryToMin($w, $h, $image);
		//Изменяем размер изображения
        $image->resizeImage($geometryToMin[0], $geometryToMin[1], $filter, $blur, false);
        //Применяем функцию функцию резкости
        $image->sharpenImage($radius, $sigma);
        //Устанавливаем формат изображения согласно mime типу
        $image->setImageFormat($format);
        //Устанавливаем тип компресии перед сохранением
        $image->setImageCompression($compressionType);
        //Устанавливаем качество
        $image->setImageCompressionQuality($compression);
        //Сохраняем изображение
        $image->writeImage($newFileName);
        //Уничтожаем объект
        $image->destroy();

        return [
            $geometryToMin[0],
            $geometryToMin[1]
        ];
    }

    /**
     * Получить новую размерность "по меньшей стороне" для дальнейшего масштабирования
     */
    private function getGeometryToMin($newWidth, $newHeight, $image) {
        // Определяем размеры изображения
        $imageGeometry = $image->getImageGeometry();
        $width = $imageGeometry['width'];
        $height = $imageGeometry['height'];

        $ratio = $width / $height;

        if ($ratio > 1) {
                // Если ориентация альбомная
                $ratioWidth = $width / $newWidth;
                $widthToMin = $newWidth;
                $heightToMin = $height / $ratioWidth;
        } else {
                // Если ориентация портретная
                $ratioHeight = $height / $newHeight;
                $widthToMin = $width / $ratioHeight;
                $heightToMin = $newHeight;
        }

        return [
                $widthToMin,
                $heightToMin
        ];
    }
}