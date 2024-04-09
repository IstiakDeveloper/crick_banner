<?php

namespace App\Livewire;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Response;

class CricketBannerGenerator extends Component
{
    use WithFileUploads;

    public $teamName;
    public $teamTagline;
    public $players = [];
    public $generatedBannerUrl;

    public function render()
    {
        return view('livewire.cricket-banner-generator');
    }

    public function addPlayer()
    {
        $this->players[] = ['name' => '', 'role' => '', 'photo' => ''];
    }

    public function removePlayer($index)
    {
        unset($this->players[$index]);
        $this->players = array_values($this->players);
    }

public function generateBanner()
{
    try {
        $team = Team::create([
            'name' => $this->teamName,
            'tagline' => $this->teamTagline,
        ]);

        foreach ($this->players as $player) {
            // Store the uploaded photo and get the path
            $photoPath = $this->storeUploadedPhoto($player['photo']);
            $team->players()->create([
                'name' => $player['name'],
                'role' => $player['role'],
                'photo' => $photoPath,
            ]);
        }

        // Generate image with all information using GD library
        $imageName = str_replace(' ', '_', $team->name) . '_banner.jpg';
        $this->generateImage($team, $imageName);

        // Set the generated banner URL to the dynamically generated image URL
        $this->generatedBannerUrl = asset('images/' . $imageName);

        session()->flash('message', 'Banner generated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', 'Failed to generate banner: ' . $e->getMessage());
    }
}


    protected function storeUploadedPhoto($photo)
    {
        // Generate a unique file name
        $fileName = uniqid() . '-' . $photo->getClientOriginalName();

        // Store the uploaded photo in the photos directory
        $photo->storeAs('public/photos', $fileName);

        // Return the stored file path
        return 'photos/' . $fileName;
    }

    protected function generateImage($team)
    {
        // Generate the image using GD library
        $image = imagecreatetruecolor(800, 600);
        $background = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $background);

        // Set font color
        $textColor = imagecolorallocate($image, 0, 0, 0);

        $fontfile = public_path('Roboto.ttf');
        // Add team name
        imagettftext($image, 24, 0, 50, 50, $textColor, $fontfile, $team->name);

        // Add team tagline
        imagettftext($image, 18, 0, 50, 100, $textColor, $fontfile, $team->tagline);

        // Add player details
        $y = 150;
        foreach ($team->players as $player) {
            // Add player name and role
            imagettftext($image, 18, 0, 50, $y, $textColor, $fontfile, $player->name . ' - ' . $player->role);
            // Add player photo
            $playerPhoto = imagecreatefromjpeg(public_path('storage/' . $player->photo));
            imagecopyresized($image, $playerPhoto, 400, $y - 20, 0, 0, 100, 100, imagesx($playerPhoto), imagesy($playerPhoto));
            $y += 120;
        }

        // Save image to file
        $imageName = str_replace(' ', '_', $team->name) . '_banner.jpg';
        $imagePath = public_path('images/' . $imageName);
        File::ensureDirectoryExists(dirname($imagePath));
        imagejpeg($image, $imagePath);

        $this->generatedBannerUrl = asset('images/' . $imageName);
    }


}
