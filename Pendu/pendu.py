# Thomas Lambert
# Le pendu
from random import choice

def check_input(param):
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
    Cette fonction choisi un mot au hasard.
    '''
    return choice(dico)


def display_letter(word, count, letter, lst):
    '''
    Si elle n'existe pas encore, cette fonction créée une liste remplie de _ pour chaque lettre du mot.
    Sinon elle ajoute au bon endroit la lettre entrée par l'utilisateur (si elle est correcte).
    Return : la liste [_ _] et count. 
    '''
    if len(lst) == 0:
        for _ in range(len(word)):
            lst.append('_')
        print(' '.join(lst))
        return lst, count

    elif letter not in word:
        print('Mauvaise lettre')
        count = display_hangman(count)
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
    letter = check_input('Entrez une lettre: ').upper()

    while letter in letters:
        print("Cette lettre a déjà été entrée.")
        print(f"Liste de lettre(s) déjà entrée(s): {' '.join(letters)}")
        letter = check_input('Entrez une lettre: ').upper()

    letters.append(letter)

    return letter, letters


def display_hangman(count):
    '''
    Cette fonction affiche progressivement le pendu.
    Return : le compteur count + 1.
    '''
    hangman = [
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
    return count + 1

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


def main():
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
    

if __name__ == '__main__':
    while True:
        main()
        again = check_input("Voulez-vous recommencer?(o/n) ")
        while again not in ['o', 'n']:
            print('(o/n)')
            again = check_input("Voulez-vous recommencer?(o/n) ")
        if again == 'n':
            break