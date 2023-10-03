<?php

namespace Tests\Browser;

use Exception;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileDownloadTest extends DuskTestCase
{
    public function testDownloadFile()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://www.mcxindia.com/technology/ctcl/ctcl-downloads');
            $browser->maximize();
            $browser->click('#form1 > div.wrapper > div.main-content > div > div > div.col-lg-7.col-md-9.col-sm-8.borderR > div:nth-child(2) > div > div:nth-child(4) > table > tbody > tr:nth-child(2) > td:nth-child(3) > a');
            $browser->pause(3000);
        });
        $this->store('C:\Users\Niraj Dangi\Downloads', 'C:\Users\Niraj Dangi\OneDrive\Desktop\demo1');
    }
    public function store($path, $destinationDirectory)
    {
        $directory = $path; // Replace with the actual path to your download folder
        $latestFile = null;
        $latestTime = 0;

        // Open the directory
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $filePath = $directory . '/' . $file;
                    $fileTime = filemtime($filePath); // Get the modification timestamp

                    if ($fileTime > $latestTime) {
                        $latestTime = $fileTime;
                        $latestFile = $file;
                    }
                }
            }
            closedir($handle);

            if ($latestFile) {
                $s1 = pathinfo($latestFile, PATHINFO_EXTENSION);
                if ($s1 == 'zip') {
                    $m = File::move($path . '\\' . $latestFile, $destinationDirectory . '\\' . $latestFile);
                    if ($m) {
                        echo "file uploaded";
                    }
                }
            } else {
                echo "No files found in the download folder.";
            }
        }
    }
}
