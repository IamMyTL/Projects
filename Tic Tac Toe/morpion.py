from random import randint, choice
from os import system
import platform

# Thomas Lambert
# Tic-Tac-Toe pvp / random / ia

switch = True
index = randint(0, 1)  # Détermine qui commence
#index = 1 # Ia commence toujours
#index = 0 # Joueur commence toujours
count = 9  # Si count = 0 --> Egalité
players = ["O", "X"]
board = [["1", "2", "3"], ["4", "5", "6"], ["7", "8", "9"]]
lst = ["1", "2", "3", "4", "5", "6", "7", "8", "9"]
joueurs = []


def game(player, joueur, board):
    """
    Fonction principale du jeu.
    """
    global switch, count
    corner = ["1", "3", "7", "9"]
    while switch == True:
        if joueur == "IA":
            win = victory_turn()
            not_win = not_victory_turn()
            if win == False:
                if not_win == False:
                    for i in corner:
                        if i in lst:
                            case = i
                            break
                        else:
                            case = choice(lst)
                    print(f"L'ia choisi une case: {case}")
                    loop(player, board, case)
                else:
                    case = not_win
                    print(f"L'ia choisi une case: {case}")
                    loop(player, board, case)
            else:
                case = win
                print(f"L'ia choisi une case: {case}")
                loop(player, board, case)
        elif joueur == "IAr":
            case = choice(lst)
            print(f"L'ia choisi une case: {case}")
            loop(player, board, case)
        else:
            case = str(input(f"{joueur} ({player}) choisi une case: "))
            loop(player, board, case)
    switch = True
    count -= 1
    clean() #Clear la console pour faire plus "propre"

    print(f"{joueur} ({player}) a choisit la case {case}")
    for i in board:
        print(" ".join(i))

    return board


def loop(player, board, case):

    global switch
    if case != "O" and case != "X":
        for i in range(3):
            for j in range(3):
                if board[i][j] == case:
                    board[i][j] = player
                    lst.remove(case)
                    switch = False
                    return board
    print(f"La case {case} est déjà prise ou n'existe pas.")


def check_victory(board, player, joueur):
    """
    Fonction qui vérifie si quelqu'un a gagné.
    """
    victory = [
        [board[0][0], board[0][1], board[0][2]],
        [board[1][0], board[1][1], board[1][2]],
        [board[2][0], board[2][1], board[2][2]],
        [board[0][0], board[1][0], board[2][0]],
        [board[0][1], board[1][1], board[2][1]],
        [board[0][2], board[1][2], board[2][2]],
        [board[0][0], board[1][1], board[2][2]],
        [board[2][0], board[1][1], board[0][2]],
    ]
    if [player, player, player] in victory:
        print(f"{joueur} ({player}) a gagné !")
        return True
    else:
        return False


def victory_turn():
    """
    Fonction qui vérifie si le prochain coup peut donner la victoire et renvoie la case gagnante sinon renvoie False.
    """
    victory = [
        [board[0][0], board[0][1], board[0][2]],
        [board[1][0], board[1][1], board[1][2]],
        [board[2][0], board[2][1], board[2][2]],
        [board[0][0], board[1][0], board[2][0]],
        [board[0][1], board[1][1], board[2][1]],
        [board[0][2], board[1][2], board[2][2]],
        [board[0][0], board[1][1], board[2][2]],
        [board[2][0], board[1][1], board[0][2]],
    ]
    for i in ['O', 'X']:
        for j in victory:
            if j[0] == i and j[1] == i and j[2] not in ['O', 'X']:
                return j[2]
            elif j[0] == i and j[2] == i and j[1] not in ['O', 'X']:
                return j[1]
            elif j[1] == i and j[2] == i and j[0] not in ['O', 'X']:
                return j[0]
    return False

def not_victory_turn():
    victory = [
        [board[0][0], board[0][1], board[0][2]],
        [board[1][0], board[1][1], board[1][2]],
        [board[2][0], board[2][1], board[2][2]],
        [board[0][0], board[1][0], board[2][0]],
        [board[0][1], board[1][1], board[2][1]],
        [board[0][2], board[1][2], board[2][2]],
        [board[0][0], board[1][1], board[2][2]],
        [board[2][0], board[1][1], board[0][2]],
    ]
    if board[1][1] not in ['O', 'X']:
        return "5"
    else:
        for j in victory:
            if j[0] not in ['O', 'X'] and j[1] not in ['O', 'X'] and j[2] == 'O':
                return j[choice((0, 1))]
            elif j[0] not in ['O', 'X'] and j[2] not in ['O', 'X'] and j[1] == 'O':
                return j[choice((0, 2))]
            elif j[1] not in ['O', 'X'] and j[2] not in ['O', 'X'] and j[0] == 'O':
                return j[choice((1, 2))]
        return False

def clean():
    """
    Clears the console
    """
    os_name = platform.system().lower()
    if "windows" in os_name:
        system("cls")
    else:
        system("clear")


# Séléction du mode de jeu
while True:
    versus = str(
        input("Joueur vs joueur, joueur vs random ou joueur vs IA? (PVP / Random / IA)")
    )
    if versus == "pvp" or versus == "PVP":
        joueurs.append(str(input("Entrez le nom joueur (O): ")))
        joueurs.append(str(input("Entrez le nom du joueur (X): ")))
        break
    elif versus == "Random" or versus == "random":
        joueurs.append("IAr")
        joueurs.append(str(input("Entrez votre nom: ")))
        break
    elif versus == "ia" or versus == "IA":
        joueurs.append("IA")
        joueurs.append(str(input("Entrez votre nom: ")))
        break
    else:
        print("Réponse attendue: PVP / Random / IA")

for i in board:
    print(" ".join(i))

#Début du programme
while True:
    index = 0 if index == 1 else 1
    player = players[index]
    joueur = joueurs[index]
    game(player, joueur, board)
    if check_victory(board, player, joueur) == True:
        break
    if count == 0:
        print("Egalité !")
        break