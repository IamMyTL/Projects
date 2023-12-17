# Thomas Lambert
# Le pendu
from random import choice
from os import system
import platform
import time

def menu() -> int:
    """
    Affiche un menu et renvoie un résultat
    :return: Un nombre entre 0 et 3
    """
    print("Jeu du pendu")
    print("1.\t Jeu")
    print("2.\t Ajouter un nouveau mot au dictionnaire")
    print("3.\t Afficher le leaderboard")
    print("\n0.\t Quitter l’application\n")
    r = "-1"
    while not r.isdigit() or int(r) not in [0, 1, 2, 3]:
        r = input("Votre choix :")
    return int(r)


def check_input(param, typ='s'):
    '''
    typ = 'i' -> int
    typ = 'l' -> que des lettres
    typ = 's -> str
    '''
    message = input(param)
    if typ == 'i':
        while message.isdigit() == False:
            print("Erreur \nRecommencez")
            message = input(param)
        return int(message)
    
    elif typ == 'l':
        while message.isalpha() == False:
            print("Erreur \nRecommencez")
            message = input(param)
        return str(message)
    
    elif typ == 's':
        return message


def check_letter(param):
    '''
    Cette fonction vérifie que l'utilisateur n'entre qu'une seule lettre et pas de chiffre.
    '''
    while True:
        message = input(param)
        if len(message) == 1:
            if message.isalpha() == True:
                return message
        print("Veillez n'entrer qu'une lettre et rien d'autre.")


def load(file):
    '''
    Cette fonction lit un fichier et renvoie son contenu.
    '''
    with open(file) as f:
        dico = f.read().splitlines()
    return dico


def pick(dico):
    '''
    Cette fonction choisi un mot au hasard en fonction de la difficulté choisie.
    '''
    print('Choisissez la dificulté.')
    print('1.\t Facile --> 6 lettres uniquement.')
    print('2.\t Normale --> Entre 6 et 9 lettres.')
    print('3.\t difficile --> Entre 8 et 12 lettres.')
    print('4.\t Maître --> Plus de 12 lettres uniquement.')
    difficulty = -1
    while difficulty not in [1, 2, 3, 4]:
        difficulty = check_input("Choisissez la difficulté: ", 'i')
    
    new_dico = []
    if difficulty == 1:
        for word in dico:
            if len(word) == 6:
                new_dico.append(word)

    elif difficulty == 2:
        for word in dico:
            if 6 < len(word) < 9:
                new_dico.append(word)

    elif difficulty == 3:
        for word in dico:
            if 8 < len(word) < 12:
                new_dico.append(word)

    elif difficulty == 4:
        for word in dico:
            if len(word) > 12:
                new_dico.append(word)
                
    return choice(new_dico)


def display_letter(word, count, letter, lst):
    '''
    Si elle n'existe pas encore, cette fonction créée une liste remplie de _ pour chaque lettre du mot.
    Sinon elle ajoute au bon endroit la lettre entrée par l'utilisateur (si elle est correcte).
    Return : la liste [_ _] et count. 
    '''
    clean()
    display_hangman(count)
    if len(lst) == 0:
        for _ in range(len(word)):
            lst.append('_')
        print(' '.join(lst))
        return lst, count

    elif letter not in word:
        clean()
        print('Mauvaise lettre')
        count += 1
        display_hangman(count)
        print(' '.join(lst))
        return lst, count

    indexes = [i for i, x in enumerate(word) if x == letter]
    for index in indexes:
        lst[index] = letter
    print(' '.join(lst))
    return lst, count


def ask_letter(letters):
    '''
    Cette fonction demande à l'utilisateur d'entrer une lettre et vérifie si elle a déjà été choisie ou non.
    Si la lettre n'a pas été choisie, elle est ajoutée dans une liste.
    Return : la lettre entrée et la liste de lettres déjà entrées.
    '''
    letter = check_letter('Entrez une lettre: ').upper()

    while letter in letters:
        print("Cette lettre a déjà été entrée.")
        print(f"Liste de lettre(s) déjà entrée(s): {' '.join(letters)}")
        letter = check_letter('Entrez une lettre: ').upper()

    letters.append(letter)

    return letter, letters


def display_hangman(count):
    '''
    Cette fonction affiche l'état du pendu.
    '''
    hangman = ['',
        '''

    |   
    |   
    |   
    |    
    |''',
        '''
     ___
    |   |
    |   
    |   
    |    
    |''',
        '''
     ___
    |   |
    |   O
    |   
    |    
    |''',
        '''
     ___
    |   |
    |   O
    |   | 
    |    
    |''',
        ''' 
     ___
    |   |
    |   O
    |  /| 
    |    
    |''',
        ''' 
     ___
    |   |
    |   O
    |  /|\ 
    |    
    |''',
        '''
     ___
    |   |
    |   O
    |  /|\ 
    |  /  
    |''',
    '''
     ___
    |   |
    |   O    HANGMAN
    |  /|\ 
    |  / \ 
    |  '''
    ]
    print(hangman[count])


def win_lose(count, lst):
    '''
    Cette fonction vérifie si l'utilisateur a gagné, perdu ou si la partie est toujours en cour.
    '''
    if count == 8:  #Après 8 erreurs, l'utilisateur à perdu.
        print('Vous avez perdu.')
        return "Perdu"
    
    elif '_' not in lst:
        print('Vous avez gagné !')
        return "Gagné"

    return False


def sorted_dico(dico, file):
    '''
    Cette fonction trie par nombre de lettre les mots du dictionnaire avant de les enregistrer dans le fichier dico.txt.
    '''
    dico_sorted = sorted(dico, key=len)
    a = "\n".join(dico_sorted)
    with open(file, 'w') as f:
        f.write(a)
    return load(file)


def add_word(dico, file):
    '''
    Cette fonction demande un nouveau mot à l'utilisateur, si le mot possède au moins 6 lettres et n'est pas déjà dans le dico,
    elle l'ajoute dans le fichier dico.txt
    '''
    new_word = check_input('Entrez un nouveau mot à ajouter: ', 'l')
    if new_word not in dico and len(new_word) >= 6:
        new_word = "\n" + new_word
        with open(file, 'a') as f:
            f.write(new_word)
        return load(file)

    else:
        print("Le mot est déjà dans le dico ou n'a pas au moins 6 lettres.")
        return load(file)


def leaderboard(word, letters, leaderboard_, finish_time):
    '''
    Cette fonction créé ou complète une liste du leaderboard sous forme [(nom, longueur, nombre de coups, temps)].
    Elle trie les données selon la longueur puis le nombre de coups et enfin le temps pour les ex-aequo.
    Return : la liste du leaderboard
    '''
    nbr_lettres = len(word)
    nbr_coups = len(letters)
    finish_time = round(finish_time, 4)
    name = check_input('Entrez votre nom: ', 's')
    leaderboard_.append((name, nbr_lettres, nbr_coups, finish_time))
    leaderboard_ = sorted(leaderboard_, key = lambda x: (-x[1], x[2], x[3]))

    if len(leaderboard_) > 5:
        leaderboard_.pop()

    return leaderboard_


def display_leaderboard(leaderboard_):
    '''
    Cette fonction affiche le leaderboard.
    '''
    print('=====LEADERBOARD=====')
    print('Nom - Longueur - Nombre de coups - Temps')
    count = 1
    for x in leaderboard_:
        print(f'{count}.', end=' ')
        print(' | '.join(str(i) for i in x))
        count += 1
    print('=====================\n')


def save_leaderboard(leaderboard_, file):
    '''
    Cette fonction enregistre le leaderboard dans un fichier binaire.
    '''
    a = ''
    for x in leaderboard_:
        a += ' '.join(str(i) for i in x) + '\n'
    
    buffer = a.encode('ascii')

    with open('leaderboard.txt', 'bw') as f:
        f.write(buffer)


def load_leaderboard(file):
    '''
    Cette fonction récupère le leaderboard du fichier binaire et return les données sous la forme
    [(nom, longueur, nombre de coups, temps)].
    '''
    with open(file, 'br') as f:
        buffer = f.read()
        lst = buffer.decode('ascii').splitlines()
    leaderboard_ = []
    
    for elem in lst:
        a = elem.split()
        a[1] = int(a[1])
        a[2] = int(a[2])
        a[3] = float(a[3])
        leaderboard_.append(tuple(a))

    return leaderboard_


def clean():
    """
    Nettoie le terminal et prend en commpte les autres os que windows
    """
    os_name = platform.system().lower()
    if "windows" in os_name:
        system("cls")
    else:
        system("clear")


def main():
    start_time = time.time()
    letters = []
    count = 0
    dico = load('dico.txt')
    word = pick(dico).upper()
    y = display_letter(word, count, 'a', [])
    empty_word = y[0]
    count = y[1]
    while win_lose(count, empty_word) == False:
        x = ask_letter(letters)
        letter = x[0]
        letters = x[1]
        y = display_letter(word, count, letter, empty_word)
        empty_word = y[0]
        count = y[1]
    finish_time = time.time() - start_time
    leaderboard_ = load_leaderboard('leaderboard.txt')
    leaderboard_ = leaderboard(word, letters, leaderboard_, finish_time)
    display_leaderboard(leaderboard_)
    save_leaderboard(leaderboard_, 'leaderboard.txt')
    

if __name__ == '__main__':
    m = -1
    while not m == 0:
        m = menu()
        if m == 1:
            main()

        elif m == 2:
            dico = load('dico.txt')
            dico = add_word(dico, 'dico.txt')
            dico = sorted_dico(dico, 'dico.txt')

        elif m == 3:
            leaderboard_ = load_leaderboard('leaderboard.txt')
            display_leaderboard(leaderboard_)