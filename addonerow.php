	function addRow(tableau){
    tableau = document.getElementById(tableau);
    //Calcul du nombre de cellule par ligne dans le tableau -> on regarde combien il y a de td dans le premier tr
    var tds = tableau.getElementsByTagName('tr')[0].getElementsByTagName('td').length;
     
    var tr = document.createElement('tr'); //On créé une ligne
    //On ajoute autant les cellules
    for(var i=0; i<tds; i++){
        var td = document.createElement('td');
        tr.appendChild(td);
         
        //Si on veut mettre du contenu dans la cellule créée, ça se passe ici (sinon il suffit de supprimer cette ligne)
        td.innerHTML = 'Une nouvelle cellule';
    }
     
    //On ajoute la ligne créée au tableau : attention, sur firefox on peut ajouter directement au tableau, mais IE ajoute par défaut un noeud tbody à la table
    if(tableau.firstChild.tagName == 'TBODY'){
        tableau.firstChild.appendChild(tr);
    }
    else{
        tableau.appendChild(tr);
    }
}
<a href="javascript:addRow('paiement1');">Ajouter une ligne</a>

	function AddOneRow(){



		var newRow = document.getElementById('paiement1').insertRow(-1);

		var newCell = newRow.insertCell(0);

		newCell.innerHTML = '[nouveau nom]';

		newCell = newRow.insertCell(1);

		newCell.innerHTML = '[nouveau prenom]';



	}
	<input type="button" value="Ajouter une personne" onClick=??? >