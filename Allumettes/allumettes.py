# Thomas Lambert
# Jeux des allumettes
# Test pour git 
from random import randint

joueurs = []


def menu() -> int:
    """
    Affiche un menu et renvoie un résultat
    :return: Un nombre entre 0 et 2
    """
    print("Jeu des allumettes")
    print("1.\t Jeu")
    print("\n0.\t Quitter l’application\n")
    r = "-1"
    while not r.isdigit() or int(r) not in [0, 1]:
        r = input("Votre choix :")
    return int(r)


def check_input(param, typ="i"):
    """
    Vérifie si la phrase est bien une str ou un int.
    typ = s -> string sinon int par défaut.
    """
    message = input(param)

    if typ == "i":
        while message.isdigit() == False:
            print("Erreur \nRecommencez")
            message = input(param)

    if typ == "s":
        return str(message)
    else:
        return int(message)


def nbr_allumettes():
    """
    Fonction qui demande le nombre d'allumette (entre 20 et 100).
    :return: Le nombre d'allumette {count} et la liste {allumettes} avec des "|" dedans.
    """
    count = check_input("\nEntrez le nombre d'allumettes (entre 20 et 100): ")
    while not 20 <= count <= 100:
        print("\nSeulement entre 20 et 100 !")
        count = check_input("\nEntrez le nombre d'allumettes (entre 20 et 100): ")
    allumettes = ["|" for _ in range(count)]
    return allumettes, count


def tire(nbr, allumettes, count):
    """
    Cette fonction retire {nbr} allumettes de la liste {allumettes}.
    :return: La liste {allumettes} et le nombre d'allumettes restantes {count}.
    """
    count -= nbr
    for _ in range(nbr):
        for i in range(len(allumettes) - 1, -1, -1):
            if allumettes[i] == "|":
                allumettes[i] = "-"
                break
    print("".join(allumettes), count, "\n")
    return allumettes, count


def jeu(joueurs, allumettes, count):
    """
    C'est la fonction principale du jeu.
    """
    print("".join(allumettes), count)
    index = randint(0, 1)  # Le premier joueur est choisi au hasard.

    while count > 3:
        nbr = -1
        joueur = joueurs[index]
        index = 0 if index == 1 else 1  # Alterne entre les 2 joueurs
        if joueur.startswith("IAI"):    #Cette condition définit le nombre d'allumette(s) que l'IA Intelligente doit tirer.
            if count % 4 == 0:
                nbr = 3
            elif count % 4 == 3:
                nbr = 2
            elif count % 4 == 2:
                nbr = 1
            elif count % 4 == 1:        #Si l'IA Intelligente ne peut pas avoir un bon nombre d'allumettes, elle tirera au hasard.
                nbr = randint(1, 3)
            print(f"{joueur} a tiré {nbr} allumettes.")

        elif joueur.startswith("IAR"):  #L'IA Random tire au hasard.
            nbr = randint(1, 3)
            print(f"{joueur} a tiré {nbr} allumettes.")

        else:
            while not 1 <= nbr <= 3:
                print(f"{joueur} peut tirer 1, 2 ou 3 allumettes.")
                nbr = check_input(f"Combien d'allumette(s) {joueur} tire?: ")

        a = tire(nbr, allumettes, count)
        allumettes = a[0]
        count = a[1]

    while count > 1:
        if count == 3:  #Les contitions de victoire à la fin de la partie.
            joueur = joueurs[index]
            index = 0 if index == 1 else 1  # Alterne entre les 2 joueurs
            nbr = -1

            if joueur.startswith("IAI"):
                nbr = 2
                print(f"{joueur} a tiré {nbr} allumettes.")

            elif joueur.startswith("IAR"):
                nbr = randint(1, 2)

                print(f"{joueur} a tiré {nbr} allumettes.")
            else:
                while not 1 <= nbr <= 2:
                    print(f"{joueur} peut tirer 1 ou 2 allumettes.")
                    nbr = check_input(f"Combien d'allumette(s) {joueur} tire?: ")

            a = tire(nbr, allumettes, count)
            allumettes = a[0]
            count = a[1]

        elif count == 2:
            joueur = joueurs[index]
            nbr = -1

            if joueur.startswith("IAI") or joueur.startswith("IAR"):
                nbr = 1
                print(f"{joueur} a tiré {nbr} allumettes.")

            else:
                while not nbr == 1:
                    print(f"{joueur} ne peut tirer que 1 allumette.")
                    nbr = check_input(f"Combien d'allumette(s) {joueur} tire?: ")

            a = tire(nbr, allumettes, count)
            allumettes = a[0]
            count = a[1]
                    
    print(f"{joueur} a gagné !\n")


if __name__ == "__main__":

    m = -1
    while not m == 0:
        m = menu()  # 0 - 1

        if m == 1:
            print("\n\tSi le nom du joueur commence par IAR -> IA Random")          #"IAR Cédric" -> IA Random qui s'appelle Cédric
            print("\n\tSi le nom du joueur commence par IAI -> IA Intelligente")    #"IAI Thomas" -> IA Intelligente qui s'appelle Thomas
            print("\n\tUn autre nom sera compté comme un vrai joueur")              #"Max" -> Vrai joueur qui s'appelle Max
            print("\n\tLes IA peuvent s'affronter entre elles.\n")
            joueurs.append(check_input("Entrez le nom du premier joueur: ", "s"))
            joueurs.append(check_input("\nEntrez le nom du deuxième joueur: ", "s"))
            a = nbr_allumettes()
            jeu(joueurs, a[0], a[1])
            joueurs = []    #Reset la liste des joueurs