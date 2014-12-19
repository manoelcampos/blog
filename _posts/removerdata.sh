#!/bin/bash
echo "Exclui o campo date: do cabeçalho dos arquivos markdown pois ao usar o Spress para gerar o site, ele estava reclamando de tal campo."
for f in *.markdown ; do 
	awk '!/date: /' "$f"  > temp && mv temp "$f" ; 
done
rm -f temp