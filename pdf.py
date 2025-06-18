#!/usr/bin/env python3
"""
extract_pdf_to_txt.py

Extrai o texto de páginas selecionadas de um PDF fixo (livro.pdf)
e grava o resultado em texto.txt.

Para mudar as páginas a extrair, basta editar a lista 'paginas'
na parte de uso ao final do arquivo.
"""

from PyPDF2 import PdfReader


def extrair_texto(
    paginas: list[int], pdf_path: str = "livro.pdf", output_path: str = "texto.txt"
) -> None:
    """
    Extrai o texto das páginas indicadas (1-based) do PDF especificado
    e grava tudo em um arquivo de texto.

    Args:
        paginas: lista de números de página (começando em 1).
        pdf_path: caminho fixo para o PDF (padrão: livro.pdf).
        output_path: caminho do arquivo de saída (padrão: texto.txt).
    """
    reader = PdfReader(pdf_path)
    num_pages = len(reader.pages)
    partes: list[str] = []

    for p in paginas:
        idx = p - 1  # converter para índice zero-based
        if idx < 0 or idx >= num_pages:
            raise ValueError(f"Página {p} está fora do intervalo (1–{num_pages}).")
        pagina = reader.pages[idx]
        texto_pagina = pagina.extract_text() or ""
        partes.append(f"--- Página {p} ---\n{texto_pagina}")

    resultado = "\n\n".join(partes)

    with open(output_path, "w", encoding="utf-8") as f:
        f.write(resultado)

    print(f"Texto extraído das páginas {paginas} e salvo em '{output_path}'.")


if __name__ == "__main__":
    pagina_inicial = 104
    num_paginas = 14
    paginas = range(pagina_inicial, pagina_inicial + num_paginas)
    extrair_texto(paginas)
