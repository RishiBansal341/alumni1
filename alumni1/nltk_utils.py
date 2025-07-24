import numpy as np
import nltk
from nltk.stem.porter import PorterStemmer

stemmer = PorterStemmer()

def tokenize(sentence):
    """
    Splits a sentence into an array of words/tokens.
    A token can be a word, punctuation character, or number.
    
    Example:
    sentence = "Hello! How are you?"
    -> ['Hello', '!', 'How', 'are', 'you', '?']
    
    This function will help in extracting each word or punctuation
    from the alumni chatbot intents to process them further.
    """
    return nltk.word_tokenize(sentence)

def stem(word):
    """
    Stemming: Find the root form of a word (stem).
    
    Examples:
    words = ["alumni", "alumnus", "alumni's"]
    stemmed = ["alumn", "alumn", "alumn"]
    
    This helps to normalize similar words in the alumni chatbot
    so they can be matched even with slight variations.
    """
    return stemmer.stem(word.lower())

def bag_of_words(tokenized_sentence, words):
    """
    Create a bag-of-words array: 
    1 for each known word that exists in the sentence, 0 otherwise.
    
    This function creates a numerical representation of a sentence
    based on its words. It is used in training the chatbot model
    to classify user input based on the presence of certain words.
    
    Example:
    tokenized_sentence = ["hello", "how", "are", "you"]
    words = ["hi", "hello", "I", "you", "bye", "thank", "cool"]
    bag_of_words = [0, 1, 0, 1, 0, 0, 0]
    
    Args:
    tokenized_sentence (list): List of words/tokens from the user input.
    words (list): All possible words from the intents file.
    
    Returns:
    np.array: A binary array indicating the presence of known words.
    """
    # Stem each word in the tokenized sentence
    sentence_words = [stem(word) for word in tokenized_sentence]

    # Initialize the bag with 0 for each word
    bag = np.zeros(len(words), dtype=np.float32)
    
    # Use a set for faster lookups
    words_set = set(sentence_words)

    for idx, w in enumerate(words):
        if w in words_set: 
            bag[idx] = 1

    return bag
