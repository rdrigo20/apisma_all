# Custom post types:

- Cards
- Carousel
- Events
- News_details
- News

# Endpoints:

### Create:

*Parâmetros gerais*: Tipo da postagem e os parâmetros do tipo.

**‘cards_create’** = cria uma postagem do tipo ‘cards’.
*Parâmetros*:
- “titulo” = titulo da postagem.
- “descricao” = descrição da postagem.
- “link” = 
- “imagem” = url que direciona para uma imagem.

**‘carrousel_create’** = cria uma postagem do tipo ‘carrousel’
*Parâmetros*:
- “nome” = 
- “texto” = 
- “endereco” = 
- “imagem” = url que direciona para uma imagem.

**‘events_create’** = cria uma postagem do tipo ‘events’.
*Parâmetros*:
- “titulo” = título da postagem.
- “descricao” = descrição da postagem.
- “link” = 
- “data” = data atribuída ao envento.

**‘news_details_create’** = cria uma postagem do tipo ‘news_details’.
*Parâmetros*:
- “titulo” = título da postagem.
- “subtitulo” = subtítulo da postagem.
- “autor” = autor da notícia.
- “texto” = conteúdo da notícia.
- “data_news” = data da notícia.
- “imagem” = url que direciona para uma imagem.

**OBS**: os parâmetros não são necessários para a postagem, caso eles não sejam informados os campos ficaram vazios.

### Delete:
*Parâmetros gerais*: Tipo da postagem e o slug da postagem.

- "cards_delete" = exclui uma postagem do tipo ‘cards’ através do slug da postagem.
- "carrousel_delete" = exclui uma postagem do tipo ‘carrousel’ através do slug da postagem.
- "events_delete" = exclui uma postagem do tipo ‘events’ através do slug da postagem.
- "news_details_delete" = exclui uma postagem do tipo ‘news_details’ através do slug da postagem.

**OBS**: Caso o slug informado não corresponder a nenhum dos slugs de nenhuma das postagens do determinado tipo a função retornará o erro 404.

### Get:
*Parâmetros gerais*: Tipo da postagem e o slug da postagem.

- "cards_get" = lê os dados de uma postagem do tipo ‘cards’ através do slug da postagem.
- "carrousel_get" = lê os dados de uma postagem do tipo ‘carrousel’ através do slug da postagem.
- "events_get" = lê os dados de uma postagem do tipo ‘events’ através do slug da postagem.
	
**OBS**: Caso o slug informado não corresponder a nenhum dos slugs de nenhuma das postagens do determinado tipo a função retornará o erro 404.

### Get All:
*Parâmetros gerais*: Tipo das postagens.

- "cards_get_all" = lê os dados de todas as postagem do tipo ‘cards’ através do slug da postagem.
- "carrousel_get_all" = lê os dados de todas as postagem do tipo ‘carrousel’ através do slug da postagem.
- "events_get_all" = lê os dados de uma postagem do tipo ‘events’ através do slug da postagem.
- "news_get_all" = lê os dados de todas as postagem do tipo ‘news_details’ através do slug da postagem.

**OBS**: Só serão lidas postagens que ainda estão publicadas, postagens que foram deletadas não aparecerão.

### Update:
*Parâmetros gerais*: Tipo da postagem, o slug da postagem e os parâmetros do tipo.

**‘cards_upadte’** = Atualiza (modifica os dados carregados) uma postagem do tipo ‘cards’ através de seu slug.
*Parâmetros*:
- “titulo” = titulo da postagem.
- “descricao” = descrição da postagem.
- “link” = 
- “imagem” = url que direciona para uma imagem.

**‘carrousel_upadte’** =  Atualiza (modifica os dados carregados) uma postagem do tipo ‘carrousel’ através de seu slug.
*Parâmetros*:
- “nome” = 
- “texto” = 
- “endereco” = 
- “imagem” = url que direciona para uma imagem.

**‘events_upadte’** =  Atualiza (modifica os dados carregados) uma postagem do tipo ‘events’ através de seu slug.
*Parâmetros*:
- “titulo” = título da postagem.
- “descricao” = descrição da postagem.
- “link” = 
- “data” = data atribuída ao evento.

**‘news_details_upadte’** =  Atualiza (modifica os dados carregados) uma postagem do tipo ‘news_details’ através de seu slug.
*Parâmetros*:
- “titulo” = título da postagem.
- “subtitulo” = subtítulo da postagem.
- “autor” = autor da notícia.
- “texto” = conteúdo da notícia.
“data_news” = data da notícia.
- “imagem” = url que direciona para uma imagem.

**OBS**: Todos os dados carregados pela postagem serão modificados e não só aqueles que você deseja modificar, ou seja quando fizer o update de um postagem você terá que escrevê-la por completo, caso deixe algum dos parâmetros vazios aquele campo ficará vazio, independentemente do que estivesse lá previamente.
