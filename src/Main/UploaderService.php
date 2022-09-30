<?php


namespace Vxsoft\Main;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UploaderService
{
    private $entityManager;
    private $rootDir;

    public function __construct(EntityManagerInterface $entityManager, $rootDir)
    {
        $this->entityManager = $entityManager;
        $this->rootDir = $rootDir;
    }

    public function upload(?UploadedFile $file, ?string $dir): ?string
    {
        $uploadDir = 'uploads/'.$dir;
        $newFileName= null;
        if($file){
            $slugger = new AsciiSlugger();
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = $slugger->slug($originalName);
            $newFileName = sprintf('%s-%s.%s',$safeName,uniqid(), $file->getExtension());
            $file->move($uploadDir, $newFileName);
        }
        return $newFileName;
    }

    public function deleteFile($path){
        @unlink($this->rootDir.'/public'.$path);
    }

}

