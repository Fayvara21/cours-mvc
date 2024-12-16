<?php

namespace App\Model;

class Personnage
{
    protected ?int $id; // ID peut être null
    protected string $nom;
    private int $PV;
    private int $PVMax;
    private int $force;
    private int $facesDe;
    private int $chance;
    private int $XP = 0;
    private int $money;
    private string $avatar;
    protected string $classe;

    public function __construct(
        string $nom,
        int $PV,
        int $PVMax,
        int $force,
        int $facesDe = 6,
        int $chance = 50,
        int $money = 100,
        string $avatar = 'avatar.jpg',
        int $XP = 0,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->PV = $PV;
        $this->PVMax = $PVMax;
        $this->force = $force;
        $this->facesDe = $facesDe;
        $this->chance = $chance;
        $this->money = $money;
        $this->avatar = $avatar;
        $this->classe = "Personnage";
        $this->XP = $XP;
    }

    public function isAlive()
    {
        return $this->PV > 0;
    }

    public function getPv()
    {
      return $this->PV;
    }

    public function setPv(int $PV) 
    {
      $this->PV = $PV;
    }

    public function getPvMax()
    {
      return $this->PVMax;
    }

    public function setPvMax(int $PVMax) 
    {
      $this->PVMax = $PVMax;
    }

    public function getForce()
    {
      return $this->force;
    }

    public function setForce(int $Force) 
    {
     $this->force = $Force;
    }

    public function getFacesDe()
    {
      return $this->facesDe;
    }

    public function setFacesDe(int $FacesDe) 
    {
      $this->facesDe = $FacesDe;
    }

    public function getChance()
    {
      return $this->chance;
    }

    public function setChance(int $Chance) 
    {
      $this->chance = $Chance;
    }

    public function getMoney()
    {
      return $this->money;
    }

    public function setMoney(int $Money) 
    {
      $this->money = $Money;
    }

    public function getAvatar()
    {
      return $this->avatar;
    }

    public function setAvatar(string $Avatar) 
    {
      $this->avatar = "/img/$Avatar";
    }


    // Commencez à typer les propriétés pour éviter les erreurs
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return strtoupper($this->nom);
    }

    public function setNom(string $nom): void
    {
        $this->nom = trim($nom);
    }

    public function getXp()
    {
        return $this->XP;
    }

    public function gagnerXP($XP)
    {
        $this->XP += $XP;
    }

    public function levelUp()
    {
        // A IMPLEMENTER
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function attaquer(Personnage $cible)
    {

        // On lance le dé
        $scoreDe = rand(1, $this->facesDe);

        $resultat = "$this->nom lance son dé à $this->facesDe faces et obtient $scoreDe\n";

        // On ramène à une chiffre entre 0 et 1
        $factDe = $scoreDe / $this->facesDe;
        // On ajoute la chance
        $factChance = $this->chance / 100;
        // On fait une moyenne entre le dé et la chance
        $chanceFinale = ($factDe + $factChance) / 2;

        // Si le calcul est inférieur à 0.5, on rate l'attaque
        $success = $chanceFinale > 0.5;

        if (!$success) {
            $resultat .= "$this->nom rate son attaque !\n";
            return $resultat;
        } else {
            $resultat .= "$this->nom attaque $cible->nom! GRAOUUUU !\n";
            $resultat .= "$cible->nom perd $this->force PV !\n";
            $cible->PV -= $this->force;
            $resultat .= "$cible->nom a maintenant $cible->PV PV restants !\n";
        }

        return $resultat;
    }

    function ressurect()
    {
        $this->PV = $this->PVMax;
    }
}
