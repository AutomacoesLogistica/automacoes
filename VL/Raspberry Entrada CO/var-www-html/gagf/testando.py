import os
import shutil

cmainho_original = "C:/Users/EACO-MANUTENCAO/Desktop/testando/pasta1"
caimnho_novo = "C:/Users/EACO-MANUTENCAO/Desktop/testando/pasta2"

try:
    os.mkdir(caminho_novo)
except FileExistsError as e:
    print(f'Pasta {caminho_novo} ja existe.')

for root, dirs, files in os.wal(cmainho_original):
    for file in files:
        old_file_path = os.path.join(root, file)
        new_file_path = os.path.join(caminho_novo, file)
        shutil.move(old_file_path, new_file_path)
        print(f'Arquivo {file} movido com sucesso!')
