#!/usr/bin/python3
from googletrans import Translator
import sys

def translate_to_chinese(text):
    translator = Translator()
    return translator.translate(text,dest='chinese (simplified)').text

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Please call me with at least one phrase")
        sys.exit()
    text = " ".join(sys.argv[1:])
    print(translate_to_chinese(text))
