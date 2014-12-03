<?php

// je mets tout dans une string géante avec "," a chaque fin de ligne
$texte = "Libria - 82 Passage Choiseul - 75002 Paris,
Telecom Star - 15 Bd de Bonne Nouvelle - 75002 Paris,
Hypso Reprographie - 53 rue de Montmorency - 75003 Paris,
BM Pressing - 4 Bis Bd Morland - 75004 Paris,
Game Cash / CG Paris 5 - 21 rue Monge - 75005 Paris,
Chez Florence - 11 rue Dauphine - 75006 Paris,
Aux Fleurs du Bac - 69 rue du Bac - 75007 Paris,
Cordonnerie Serrurerie Grenell - 165 rue de Grenelle - 75007 Paris,
Clean Pressing - 15 rue Manuel - 75009 Paris,
Luffy - 35 rue de Clichy - 75009 Paris,
Les Coteaux de Saumur - 10 rue Bichat - 75010 Paris,
Magenta Art Deco - 34 Ter rue du Dunkerque - 75010 Paris,
Baticlean 75 - 191 rue de Charonne - 75011 Paris,
Cala Thé A - 133 rue de Montreuil - 75011 Paris,
A Livr' Ouvert - 171 Bis Bd Voltaire - 75011 Paris,
Pressing Boulle - 13 rue Boulle - 75011 Paris,
B.C.B.G / SARL Fleuve Bleu - 18 rue Jules Valles - 75011 Paris,
L'Atelier du Trèfles Cadeaux - 13 Bis Avenue Philippe Auguste - 75011 Paris,
Lio Optic - 44 Bd Diderot - 75012 Paris,
A.M Presse Bizot - 116 Av Général Michel Bizot - 75012 Paris,
Alanpark - 105 rue de Charenton - 75013 Paris,
Okbi Presse - 91 rue de Barrault - 75013 Paris,
Encherexpert - 51 rue de Clisson - 75013 Paris,
Maison de la Presse - 137 Bd Auguste Blanqui - 75013 Paris,
Ideal Optic - 101 Av de France - 75013 Paris,
Chryzalys - 206 Bd Raspail - 75014 Paris,
Agip Papeterie Côté Sud - 133 Av du Maine - 75014 Paris,
Animalerie Little Zoo - 40 Bd Brune - 75014 Paris,
Cordonnerie B.V.F - 22 rue des Volontaires - 75015 Paris,
Moveux - 14 rue Dupleix - 75015 Paris,
Saveurs du Sud - 14 Av Félix Faure - 75015 Paris,
Anwa - 105 Bis rue des Entrepreneurs - 75015 Paris,
Mercerie Poncet - 15 rue Daumier - 75016 Paris,
Vu du XII - 96 Av de Mozart - 75016 Paris,
Centre Literie - 2 Bd Bessières - 75017 Paris,
Salon Marylène - 45 rue Brochant - 75017 Paris,
Allo Micro - 117 rue Legendre - 75017 Paris,
Encherexpert - 61 rue Guy Moquet - 75017 Paris,
Au Rocher de Joie - 12 rue Lamarck - 75018 Paris,
Consoplus Informatique - 8 Bd Ney - 75018 Paris,
Unity Génération - 17 rue Simart - 75018 Paris,
Isabelle Cherchevsky Atelier - 15 rue Lagouat - 75018 Paris,
Labelencre - 10 Av de La porte Brunet - 75019 Paris,
Prim Plus - 9 rue du Cher - 75020 Paris,
Cadeaux Chics - 27 rue Saint Fargeau - 75020 Paris,
Optic 62 - 62 rue de Belleville - 75020 Paris,
Pressing 113 - 113 Bd Davout - 75020 Paris,
Copy Conforme - 25 rue Gatinée - 75020 Paris,";


// supprime retour a la ligne
$texte = str_replace("\n", "", $texte);


//je transforme en array avec explode
$dropPoints = explode("Paris,", $texte);
array_pop($dropPoints);


// ca va me servir a remplir en cascade
$data = array();


foreach($dropPoints as $dropPoint)
{
	// j'explode pareil et comme tout est séparé par " - "
	$expl = explode(" - ", $dropPoint);

	
	// bam badaboum j'injecte a chaque boucle dans data
	// ps tu changes les noms array associatif si tu veux
	$data[] = array($expl[0],$expl[1],$expl[2],'Paris');
}



