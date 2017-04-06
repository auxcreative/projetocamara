<php? Php
 / ************************************************* ******************************
  * FPDF *
  **
  * Versão: 1.6 *
  * Data: 2008-08-03 *
  * Autor: Olivier PLATHEY *
  ************************************************** ***************************** /
 definir ('FPDF_VERSION', '1 0,6 ');
 classe FPDF
 {
 var $ page, número da página / / corrente
 var $ n / / atual número objeto
 var $ compensações; / / array de compensações objeto
 var $ tampão / / buffer que in-memory PDF
 var $ páginas, / / array contendo páginas
 var $ estado / / atual estado do documento
 var $ compressa; bandeira / / compressão
 var $ k; fator / / escala (número de pontos na unidade do usuário)
 var $ DefOrientation, orientação / / default
 var $ CurOrientation / / atual orientação
 var $ PageFormats / / formatos de página disponíveis
 var $ DefPageFormat; formato de página / / default
 var $ CurPageFormat; formato de página / / corrente
 var $ PageSizes; / / array armazenar tamanhos de página não-padrão
 var $ WPT $ HPT / / dimensões da página atual em pontos
 var $ w, $ h / / dimensões da página atual na unidade do usuário
 var $ lMargin; margem / / esquerda
 var $ tMargin; margem / / top
 var $ rMargin; margem / / direita
 var $ bMargin; margem pausa / / page
 var $ cMargin; margem / / cell
 var $ x, $ y, / / posição atual na unidade do usuário
 var $ lasth / / altura da última célula impressa
 var $ LineWidth / / largura da linha na unidade do usuário
 var $ CoreFonts; / / array de nomes de fonte padrão
 var $ fontes; / / array de fontes usadas
 var $ FontFiles; / / array de arquivos de fontes
 var $ diffs / / matriz de diferenças de codificação
 var $ FontFamily; família de fonte / / corrente
 var $ FontStyle; estilo de fonte / / corrente
 var $ sublinhar / / flag sublinhando
 var $ CurrentFont / / atual Informações da fonte
 var $ FontSizePt; tamanho da fonte / / corrente em pontos
 var $ TamanhoDoTipoDeLetra; tamanho da fonte / / atual na unidade do usuário
 var $ DrawColor / / comandos para a cor de desenho
 var $ FillColor / / comandos para o preenchimento de cor
 var $ TextColor / / comandos para a cor do texto
 var $ ColorFlag / / indica se o preenchimento e cores de texto são diferentes
 var $ ws; espaçamento / / palavra
 var $ imagens; / / array de imagens utilizadas
 var $ pagelinks; / / array de links em páginas
 var $ links; / / array de links internos
 var $ AutoPageBreak; página quebra / / automático
 var $ PageBreakTrigger / / limiar usado para acionar as quebras de página
 var $ InHeader / / flag set durante o processamento de cabeçalho
 var $ InFooter / / flag definido durante o processamento de rodapé
 var $ ZoomMode; modo de exibição / / zoom
 var $ LayoutMode; / / layout modo de exibição
 var $ titulo / / título
 var $ assunto; / / assunto
 var $ autor / / autor
 var $ palavras-chave; / / palavras-chave
 var $ criador / / criador
 var $ AliasNbPages / / alias para o número total de páginas
 var $ PDFVersion; número da versão / / PDF
 / ************************************************* ******************************
  **
  * Métodos públicos *
  **
  ************************************************** ***************************** /
 função FPDF ($ orientação = 'P', $ unidade = 'mm', $ format = 'A4')
 {
	 / / Alguns cheques
	 $ This -> _dochecks ();
	 / / Inicialização de propriedades
	 $ This -> page = 0;
	 $ This -> n = 2;
	 $ This -> buffer ='';
	 $ This -> pages = gama ();
	 $ This -> PageSizes = gama ();
	 $ This -> estado = 0;
	 $ This -> fonts = gama ();
	 $ This -> FontFiles = gama ();
	 $ This -> diffs = gama ();
	 $ This -> Imagens = gama ();
	 $ This -> ligações = gama ();
	 $ This -> InHeader = false;
	 $ This -> InFooter = false;
	 $ This -> lasth = 0;
	 $ This -> FontFamily ='';
	 $ This -> FontStyle ='';
	 $ This -> FontSizePt = 12;
	 $ This -> underline = false;
	 $ This -> DrawColor G = '0 ';
	 $ This -> FillColor g = '0 ';
	 $ This -> TextColor g = '0 ';
	 $ This -> ColorFlag = false;
	 $ This -> ws = 0;
	 / / Fontes padrão
		 'Símbolo' => 'Símbolo', 'ZapfDingbats' => 'ZapfDingbats');
	 / / Escala fator
	 if ($ unidade == 'pt')
		 $ This -> k = 1;
	 elseif ($ unidade == 'mm')
		 $ This -> k = 72 / 25.4;
	 elseif ($ unidade == 'cm')
		 $ This -> k = 72 / 2,54;
	 elseif ($ unidade == 'em')
		 $ This -> k = 72;
	 outro
		 $ This -> Error ('unidade incorreta:. $ Unidade);
	 / / Página formato
		 'Carta' => array (612, 792), 'legal' => array (612, 1008));
	 if ( is_string ($ format))
		 $ Format = $ this -> _getpageformat ($ format);
	 $ This -> DefPageFormat = $ formato;
	 $ This -> CurPageFormat = $ formato;
	 / / Página orientação
	 $ Orientação = strtolower ($ orientação);
	 if ($ orientação == 'p' | | $ orientação == 'retrato')
	 {
		 $ This -> DefOrientation = 'P';
		 $ This -> w = $ this -> DefPageFormat [0];
		 $ This -> h = $ this -> DefPageFormat [1];
	 }
	 elseif ($ orientação == 'l' | | $ orientação == 'paisagem')
	 {
		 $ This -> DefOrientation = 'L';
		 $ This -> w = $ this -> DefPageFormat [1];
		 $ This -> h = $ this -> DefPageFormat [0];
	 }
	 outro
		 $ This -> Error ('orientação incorreta:. $ Orientação);
	 $ This -> CurOrientation = $ this -> DefOrientation;
	 $ This -> WPT = $ this -> w * $ this -> k;
	 $ This -> HPT = $ this -> h * $ this -> k;
	 / / Página margens (1 cm)
	 $ Margem = 28,35 / $ this -> k;
	 $ This -> SetMargins (margem $, $ margem);
	 / / Margem da célula Interior (1 mm)
	 $ This -> cMargin = $ margem / 10;
	 / / Largura de linha (0,2 mm)
	 $ This -> LineWidth = 0,567 / $ this -> k;
	 / / Quebra de página automática
	 $ This -> SetAutoPageBreak (true, 2 * $ margem);
	 Modo de exibição / / largura completa
	 $ This -> SetDisplayMode ('fullwidth');
	 / / Ativar compressão
	 $ This -> SetCompression (true);
	 / / Definir o número da versão PDF padrão
	 $ This -> PDFVersion = '1 .3 ';
 }
 função SetMargins ($ esquerda $ top, $ certo = null)
 {
	 / / Definir margens esquerda, superior e direita
	 $ This -> = $ lMargin esquerda;
	 $ This -> tMargin = $ top;
	 if ($ certo === null)
		 $ Certo = $ esquerda;
	 $ This -> rMargin = $ direita;
 }
 função SetLeftMargin ($ margem)
 {
	 / / Define a margem esquerda
	 $ This -> lMargin = $ margem;
	 if ($ this -> página> 0 && $ this -> x <$ margem)
		 $ This -> x = $ margem;
 }
 função SetTopMargin ($ margem)
 {
	 / / Set margem superior
	 $ This -> tMargin = $ margem;
 }
 função SetRightMargin ($ margem)
 {
	 / / Define a margem direita
	 $ This -> rMargin = $ margem;
 }
 função SetAutoPageBreak ($ auto, $ margem = 0)
 {
	 / / Set modo de quebra de página automática e provocando margem
	 $ This -> AutoPageBreak = $ auto;
	 $ This -> bMargin = $ margem;
	 $ This -> PageBreakTrigger = $ this -> h - $ margem;
 }
 função SetDisplayMode ($ zoom, $ layout = "contínuo")
 {
	 / Modo de exibição / Set in visualizador
	 if ($ zoom == 'fullpage' | | $ zoom == 'fullwidth' | | $ zoom == 'real' | | $ zoom == 'default' | |! is_string ($ zoom))
		 $ This -> ZoomMode = $ zoom;
	 outro
		 $ This -> Error ('modo incorreto zoom display:'. $ Zoom);
	 if ($ layout == 'single' | | $ layout == 'contínuo' | | $ layout == 'dois' | | $ layout == 'default')
		 $ This -> LayoutMode = $ layout;
	 outro
		 $ This -> Error ('modo incorreto layout de exibição:. $ Layout);
 }
 função SetCompression ($ compressa)
 {
	 / / Set compactação de página
	 if ( function_exists ('gzcompress'))
		 $ This -> compressa = $ compressa;
	 outro
		 $ This -> compressa = false;
 }
 função SetTitle ($ titulo, $ isUTF8 = false)
 {
	 / / Título do documento
	 if ($ isUTF8)
		 $ Title = $ this -> _UTF8toUTF16 ($ titulo);
	 $ This -> title = $ title;
 }
 função SetSubject ($ assunto, $ isUTF8 = false)
 {
	 / / Assunto do documento
	 if ($ isUTF8)
		 $ Assunto = $ this -> _UTF8toUTF16 ($ assunto);
	 $ This -> subject = $ assunto;
 }
 função SetAuthor ($ autor, $ isUTF8 = false)
 {
	 / / Autor do documento
	 if ($ isUTF8)
		 $ Autor = $ this -> _UTF8toUTF16 ($ autor);
	 $ This -> author = $ autor;
 }
 função SetKeywords ($ palavras, $ isUTF8 = false)
 {
	 / / Palavras-chave do documento
	 if ($ isUTF8)
		 $ Keywords = $ this -> _UTF8toUTF16 ($ palavras-chave);
	 $ This -> keywords = $ palavras-chave;
 }
 função SetCreator ($ autor, $ isUTF8 = false)
 {
	 / / Criador de documento
	 if ($ isUTF8)
		 $ Criador = $ this -> _UTF8toUTF16 ($ criador);
	 $ This -> criador = $ criador;
 }
 função AliasNbPages ($ alias = '{NB}')
 {
	 / / Define um alias para o número total de páginas
	 $ This -> AliasNbPages = $ apelido;
 }
 função de erro ($ msg)
 {
	 / / Erro Fatal
	 morrer ('erro FPDF <b>: </ b>'. $ msg);
 }
 função Open ()
 {
	 / / Comece documento
	 $ This -> estado = 1;
 }
 função Close ()
 {
	 / / Termina documento
	 if ($ this -> estado == 3)
		 voltar;
	 if ($ this -> página == 0)
		 $ This -> AddPage ();
	 / / Rodapé da página
	 $ This -> InFooter = true;
	 $ This -> Rodapé ();
	 $ This -> InFooter = false;
	 / / Fechar a página
	 $ This -> _endpage ();
	 / / Fechar documento
	 $ This -> _enddoc ();
 }
 função AddPage ($ orientação ='', $ format ='')
 {
	 / / Inicia uma nova página
	 if ($ this -> estado == 0)
		 $ This -> Open ();
	 $ Família = $ this -> FontFamily;
	 $ Style = $ this -> FontStyle ($ this -> sublinhado 'U':?'').;
	 $ Size = $ this -> FontSizePt;
	 Lw $ = $ this -> LineWidth;
	 $ Dc = $ this -> DrawColor;
	 $ Fc = $ this -> FillColor;
	 $ Tc = $ this -> TextColor;
	 $ Cf = $ this -> ColorFlag;
	 if ($ this -> página> 0)
	 {
		 / / Rodapé da página
		 $ This -> InFooter = true;
		 $ This -> Rodapé ();
		 $ This -> InFooter = false;
		 / / Fechar a página
		 $ This -> _endpage ();
	 }
	 / / Inicie uma nova página
	 $ This -> _beginpage ($ orientação, $ format);
	 / / Set linha de estilo do tampão para a praça
	 $ This -> _Out ('2 J ');
	 / / Define a largura da linha
	 $ This -> LineWidth = $ lw;
	 $ This -> _Out ( sprintf ('% .2 F w', $ lw * $ this -> k));
	 / / Set fonte
	 if ($ família)
		 $ This -> SetFont ($ família, $ estilo, $ size);
	 / / Set cores
	 $ This -> DrawColor = $ dc;
	 if ($ dc! G = '0 ')
		 $ This -> _Out ($ dc);
	 $ This -> FillColor = $ fc;
	 if ($ fc! g = '0 ')
		 $ This -> _Out ($ fc);
	 $ This -> TextColor = $ tc;
	 $ This -> ColorFlag = $ cf;
	 / / Página cabeçalho
	 $ This -> InHeader = true;
	 $ This -> Header ();
	 $ This -> InHeader = false;
	 / / Restaurar largura de linha
	 if ($ this -> LineWidth = $ lw)
	 {
		 $ This -> LineWidth = $ lw;
		 $ This -> _Out ( sprintf ('% .2 F w', $ lw * $ this -> k));
	 }
	 / / Restaurar fonte
	 if ($ família)
		 $ This -> SetFont ($ família, $ estilo, $ size);
	 / / Restaurar cores
	 if ($ this -> DrawColor = $ dc)
	 {
		 $ This -> DrawColor = $ dc;
		 $ This -> _Out ($ dc);
	 }
	 if ($ this -> FillColor = $ fc)
	 {
		 $ This -> FillColor = $ fc;
		 $ This -> _Out ($ fc);
	 }
	 $ This -> TextColor = $ tc;
	 $ This -> ColorFlag = $ cf;
 }
 função Header ()
 {
	 / / Para ser implementado em sua própria classe herdada
 }
 função de Rodapé ()
 {
	 / / Para ser implementado em sua própria classe herdada
 }
 função PageNo ()
 {
	 / / Obter o número da página atual
	 return $ this -> página;
 }
 função SetDrawColor ($ r, $ g = null, $ b = null)
 {
	 / / Set de cores para todas as operações acariciando
	 if (($ r == 0 && $ g == 0 && $ b == 0) | | $ g === null)
		 $ This -> DrawColor = sprintf ('% .3 F G', $ r / 255);
	 outro
		 $ This -> DrawColor = sprintf ('% F 0,3% 0,3% 0,3 F F RG', $ r / 255, $ g / 255, $ b / 255);
	 if ($ this -> página> 0)
		 $ This -> _Out ($ this -> DrawColor);
 }
 função SetFillColor ($ r, $ g = null, $ b = null)
 {
	 / / Set de cores para todas as operações de enchimento
	 if (($ r == 0 && $ g == 0 && $ b == 0) | | $ g === null)
		 $ This -> FillColor = sprintf ('% F 0,3 g', $ r / 255);
	 outro
		 $ This -> FillColor = sprintf ('% F 0,3% 0,3% 0,3 F F rg', $ r / 255, $ g / 255, $ b / 255);
	 $ This -> ColorFlag = ($ this -> FillColor = $ this -> TextColor!);
	 if ($ this -> página> 0)
		 $ This -> _Out ($ this -> FillColor);
 }
 função SetTextColor ($ r, $ g = null, $ b = null)
 {
	 / / Set cor do texto
	 if (($ r == 0 && $ g == 0 && $ b == 0) | | $ g === null)
		 $ This -> TextColor = sprintf ('% F 0,3 g', $ r / 255);
	 outro
		 $ This -> TextColor = sprintf ('% F 0,3% 0,3% 0,3 F F rg', $ r / 255, $ g / 255, $ b / 255);
	 $ This -> ColorFlag = ($ this -> FillColor = $ this -> TextColor!);
 }
 função GetStringWidth ($ s)
 {
	 / / Pega a largura de uma string na fonte atual
	 $ S = (string) $ s;
	 $ Cw = & $ this -> CurrentFont ['cw'];
	 $ W = 0;
	 $ L = strlen ($ s);
	 for ($ i = 0; $ i <$ l, $ i + +)
		 $ W + = $ cw [$ s [$ i]];
	 return $ w * $ this -> TamanhoDoTipoDeLetra / 1000;
 }
 função SetLineWidth ($ largura)
 {
	 / / Define a largura da linha
	 $ This -> LineWidth = $ largura;
	 if ($ this -> página> 0)
		 $ This -> _Out ( sprintf ('% .2 F w', $ width * $ this -> k));
 }
 função Line ($ x1, $ y1, $ x2, $ y2)
 {
	 / / Desenha uma linha
	 $ This -> _Out ( sprintf ('% 0,2% 0,2 F F m% 0,2% 0,2 F F l S', $ x1 * $ this -> k, ($ this -> h - $ y1) * $ this -> k, $ * $ x2 esta -> k, $ (isto -> h - $ Y2) * $ presente -> k));
 }
 função Rect ($ x, $ y, $ w, $ h, $ style ='')
 {
	 / / Desenha um retângulo
	 if ($ estilo == 'F')
		 $ Op = 'f';
	 elseif ($ estilo == 'FD' | | $ estilo == 'DF')
		 $ Op = 'B';
	 outro
		 $ Op = 'S';
	 $ This -> _Out ( sprintf ('% 0,2% 0,2 F F% 0,2% 0,2 F F re% s', $ x * $ this -> k, ($ this -> h - $ y) * $ this -> k, w * $ $ this -> k, - $ h * $ this -> k, $ op));
 }
 função AddFont ($ família, $ style ='', $ arquivo ='')
 {
	 / / Adiciona uma fonte TrueType ou Type 1
	 $ Família = strtolower ($ família);
	 if ($ file =='')
		 $ Arquivo = str_replace ('.','', $ família) strtolower .. ($ estilo) 'php';
	 if ($ família == 'arial')
		 $ Família = 'Helvetica';
	 $ Style = strtoupper ($ estilo);
	 if ($ estilo == 'IB')
		 $ Style = "BI";
	 Fontkey = $ $ $ família estilo.;
	 if ( isset ($ this -> fontes [$ fontkey]))
		 voltar;
	 include ($ this - $ file> _getfontpath ().);
	 if (! isset ($ nome))
		 $ This -> Error ('Não foi possível incluir o arquivo de definição de fonte');
	 $ I = contagem ($ this -> fontes) + 1;
	 if ($ diff)
	 {
		 / / Busca codificações existentes
		 $ D = 0;
		 $ Nb = contagem ($ this -> diffs);
		 for ($ i = 1; $ i <= $ nb; $ i + +)
		 {
			 if ($ this -> diffs [$ i] == $ diff)
			 {
				 $ D = $ i;
				 quebrar;
			 }
		 }
		 if ($ d == 0)
		 {
			 $ D = $ nb + 1;
			 $ This -> diffs [$ d] = $ diff;
		 }
		 $ This -> fontes [$ fontkey] ['diff'] = $ d;
	 }
	 if ($ file)
	 {
		 if ($ tipo == 'TrueType')
			 $ This -> FontFiles [$ file] = gama ('length1' => $ OriginalSize);
		 outro
			 $ This -> FontFiles [$ file] = gama ('length1' => $ tamanho1 'length2' => $ tamanho2);
	 }
 }
 função SetFont ($ família, $ style ='', $ size = 0)
 {
	 / / Selecione uma fonte, o tamanho da dadas em pontos
	 fpdf_charwidths $ globais;
	 $ Família = strtolower ($ família);
	 if ($ família =='')
		 $ Família = $ this -> FontFamily;
	 if ($ família == 'arial')
		 $ Família = 'Helvetica';
	 elseif ($ família == 'símbolo' | | $ família == 'ZapfDingbats')
		 $ Style ='';
	 $ Style = strtoupper ($ estilo);
	 if ( strpos ($ estilo, 'U')! == false)
	 {
		 $ This -> sublinhar = true;
		 $ Style = str_replace ('U','', $ estilo);
	 }
	 outro
		 $ This -> underline = false;
	 if ($ estilo == 'IB')
		 $ Style = "BI";
	 if ($ tamanho == 0)
		 $ Size = $ this -> FontSizePt;
	 / / Teste se a fonte já está selecionado
	 if ($ this -> FontFamily == $ && familiares $ this -> FontStyle && == $ estilo $ this -> FontSizePt == $ size)
		 voltar;
	 / / Teste se usado pela primeira vez
	 Fontkey = $ $ $ família estilo.;
	 if (! isset ($ this -> fontes [$ fontkey]))
	 {
		 / / Verifique se uma das fontes padrão
		 if ( isset ($ this -> CoreFonts [$ fontkey]))
		 {
			 if (! isset ($ fpdf_charwidths [$ fontkey]))
			 {
				 Arquivo métrica / / Carregar
				 $ Arquivo = $ família;
				 if ($ família == 'tempos' | | $ família == 'Helvetica')
					 $ File =. strtolower ($ estilo);
				 include ($ this -> _getfontpath () $ file. '. php.');
				 if (! isset ($ fpdf_charwidths [$ fontkey]))
					 $ This -> Error ('Não foi possível incluir o arquivo métrica font');
			 }
			 $ I = contagem ($ this -> fontes) + 1;
			 $ Name = $ this -> CoreFonts [$ fontkey];
			 Cw = $ $ $ fontkey fpdf_charwidths [];
			 $ This -> fontes [$ fontkey] = gama ('i' => $ i, 'type' => 'core', 'name' => $ nome, 'up' => - 100, 'ut' => 50, 'cw' => $ cw);
		 }
		 outro
			 $ This -> Error ('font indefinido:'... $ Family '$ estilo);
	 }
	 / / Selecione-o
	 $ This -> FontFamily = $ família;
	 $ This -> FontStyle = $ estilo;
	 $ This -> FontSizePt = $ size;
	 $ This -> TamanhoDoTipoDeLetra = $ size / $ this -> k;
	 $ This -> CurrentFont = & $ this -> fontes [$ fontkey];
	 if ($ this -> página> 0)
		 $ This -> _Out ( sprintf ('BT / F% d% 0,2 F Tf ET', $ this -> CurrentFont ['i'], $ this -> FontSizePt));
 }
 função SetFontSize ($ size)
 {
	 / Tamanho da fonte / Set em pontos
	 if ($ this -> FontSizePt == $ size)
		 voltar;
	 $ This -> FontSizePt = $ size;
	 $ This -> TamanhoDoTipoDeLetra = $ size / $ this -> k;
	 if ($ this -> página> 0)
		 $ This -> _Out ( sprintf ('BT / F% d% 0,2 F Tf ET', $ this -> CurrentFont ['i'], $ this -> FontSizePt));
 }
 função AddLink ()
 {
	 / / Cria um novo link interno
	 $ N = contagem ($ this -> links) + 1;
	 $ This -> ligações [$ n] = gama (0, 0);
	 return $ n;
 }
 função SetLink ($ link, $ y = 0, $ page = - 1)
 {
	 / / Definir o destino de ligação interna
	 if ($ y == - 1)
		 $ Y = $ this -> y;
	 if ($ page == - 1)
		 $ Page = $ this -> página;
	 $ This -> ligações [$ link] = matriz ($ page, $ y);
 }
 função de ligação ($ x, $ y, $ w, $ h, $ link)
 {
	 / / Coloque um link na página
 }
 função Texto ($ x, $ y, $ txt)
 {
	 / / Mostra uma string
	 $ S = sprintf ('BT% 0,2% 0,2 F F Td (% s) Tj ET', $ x * $ this -> k, ($ this -> h - $ y) * $ this -> k, $ this -> _escape ($ txt));
	 if ($ this -> sublinhar && $ txt =''!)
		 . $ S = '$ this -> _dounderline ($ x, $ y, $ txt).;
	 if ($ this -> ColorFlag)
		 $ S = 'q' $ this -..> TextColor '  . $ S. '  Q ';
	 $ This -> _Out ($ s);
 }
 função AcceptPageBreak ()
 {
	 / / Aceitar quebra de página automática ou não
	 return $ this -> AutoPageBreak;
 }
 função celular ($ w, $ h = 0, $ txt ='', $ border = 0, $ ln = 0, $ align ='', $ preencher = false, $ link ='')
 {
	 / / Saída de uma célula
	 $ K = $ this -> k;
	 {
		 / / Quebra de página automática
		 $ X = $ this -> x;
		 $ Ws = $ this -> ws;
		 if ($ ws> 0)
		 {
			 $ This -> ws = 0;
			 $ This -> _Out (Tw '0 ');
		 }
		 $ This -> AddPage ($ this -> CurOrientation, $ this -> CurPageFormat);
		 $ This -> x = $ x;
		 if ($ ws> 0)
		 {
			 $ This -> ws = $ ws;
			 $ This -> _Out ( sprintf ('% .3 F Tw', $ ws * $ k));
		 }
	 }
	 if ($ w == 0)
		 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
	 $ S ='';
	 if ($ preencher | | $ fronteira == 1)
	 {
		 if ($ preenchimento)
			 ? $ Op = ($ fronteira == 1) 'B': 'f';
		 outro
			 $ Op = 'S';
		 $ S = sprintf ('% 0,2% 0,2 F F% 0,2% 0,2 F F re% s', $ this -> x * $ k, ($ this -> h - $ this -> y) * $ k, $ w * $ k, - $ h * $ k, $ op);
	 }
	 if ( is_string ($ fronteira))
	 {
		 $ X = $ this -> x;
		 $ Y = $ this -> y;
		 if ( strpos ($ fronteira, 'L')! == false)
			 $ S =. sprintf ('% 0,2% 0,2 F F m% 0,2% 0,2 F F l S', $ x * $ k, ($ this -> h - $ y) * $ k, $ x * $ k, ($ this -> h - ($ y + $ h)) * $ k);
		 if ( strpos ($ fronteira, 'T')! == false)
			 $ S =. sprintf ('% 0,2% 0,2 F F m% 0,2% 0,2 F F l S', $ x * $ k, ($ this -> h - $ y) * $ k, ($ x + $ w ) * $ k, ($ this -> h - $ y) * $ k);
		 if ( strpos ($ fronteira, 'R')! == false)
			 $ S =. sprintf ('% 0,2% 0,2 F F m% 0,2% 0,2 F F l S', ($ x + $ w) * $ k, ($ this -> h - $ y) * $ k, ( $ x + $ w) * $ k, ($ this -> h - ($ y + $ h)) * $ k);
		 if ( strpos ($ fronteira, 'B')! == false)
			 $ S =. sprintf ('% 0,2% 0,2 F F m% 0,2% 0,2 F F l S', $ x * $ k, ($ this -> h - ($ y + $ h)) * $ k, ( $ x + $ w) * $ k, ($ this -> h - ($ y + $ h)) * $ k);
	 }
	 if ($ txt! =='')
	 {
		 if ($ alinhar == 'R')
			 $ Dx = $ w - $ this -> cMargin - $ this -> GetStringWidth ($ txt);
		 elseif ($ alinhar == 'C')
			 $ Dx = ($ w - $ this -> GetStringWidth ($ txt)) / 2;
		 outro
			 $ Dx = $ this -> cMargin;
		 if ($ this -> ColorFlag)
			 $ S = 'q' $ this -...> TextColor '  ';
		 $ Txt2 = str_replace (')', '\ \)', str_replace ('(', '\ \ (', str_replace ('\ \', '\ \ \ \', $ txt)));
		 $ S =. sprintf ('BT% 0,2% 0,2 F F Td (% s) Tj ET', ($ this -> x + dx $) * $ k, ($ this -> h - ($ this -> y + 0,5 * $ h + 0,3 * $ this -> TamanhoDoTipoDeLetra)) * $ k, $ txt2);
		 if ($ this -> sublinhado)
			 .. $ S = '$ this -> _dounderline ($ this -> x + $ dx, $ this -> y + 0,5 * $ h + 0,3 * $ this -> TamanhoDoTipoDeLetra, $ txt);
		 if ($ this -> ColorFlag)
			 $ S = 'Q'.;
		 if ($ link)
	 }
	 if ($ s)
		 $ This -> _Out ($ s);
	 $ This -> lasth = $ h;
	 if ($ ln> 0)
	 {
		 / / Ir para a próxima linha
		 $ This -> y + = $ h;
		 if ($ ln == 1)
			 $ This -> x = $ this -> lMargin;
	 }
	 outro
		 $ This -> x + = $ w;
 }
 função MultiCell ($ w, $ h, $ txt, $ border = 0, $ align = 'J', $ preencher = false)
 {
	 / / Output texto com quebras de linha automáticas ou explícita
	 $ Cw = & $ this -> CurrentFont ['cw'];
	 if ($ w == 0)
		 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
	 $ Wmax = ($ w - 2 * $ this -> cMargin) * 1000 / $ this -> FontSize;
	 $ S = str_replace ("\ r",'', $ txt);
	 $ Nb = strlen ($ s);
	 if ($ nb> 0 && $ s [$ nb - 1] == "\ n")
		 $ Nb -;
	 $ B = 0;
	 if ($ fronteira)
	 {
		 if ($ fronteira == 1)
		 {
			 $ Border = "LTRB ';
			 $ B = 'LRT';
			 $ B2 = 'LR';
		 }
		 outro
		 {
			 $ B2 ='';
			 if ( strpos ($ fronteira, 'L')! == false)
				 $ B2 = 'L'.;
			 if ( strpos ($ fronteira, 'R')! == false)
				 $ B2 = «R».
			 $ B = ( strpos ($ fronteira, 'T') == false!) $ b2 'T':?. $ b2;
		 }
	 }
	 $ Setembro = - 1;
	 $ I = 0;
	 $ J = 0;
	 $ L = 0;
	 $ Ns = 0;
	 $ Nl = 1;
	 while ($ i <$ nb)
	 {
		 / / Pega o próximo caractere
		 $ C = $ s [$ i];
		 if ($ c == "\ n")
		 {
			 / / Quebra de linha explícita
			 if ($ this -> ws> 0)
			 {
				 $ This -> ws = 0;
				 $ This -> _Out (Tw '0 ');
			 }
			 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ i - $ j), $ b, 2, $ alinhar $ preenchimento);
			 $ I + +;
			 $ Setembro = - 1;
			 $ J = $ i;
			 $ L = 0;
			 $ Ns = 0;
			 $ Nl + +;
			 if ($ && fronteira $ nl == 2)
				 $ B = $ B2;
			 continuar;
		 }
		 if ($ c == '')
		 {
			 $ Setembro = $ i;
			 $ Ls = $ l;
			 Ns + $ +;
		 }
		 $ L + cw = $ [$ c];
		 if ($ l> $ wmax)
		 {
			 / / Quebra de linha automática
			 if ($ setembro == - 1)
			 {
				 if ($ i == $ j)
					 $ I + +;
				 if ($ this -> ws> 0)
				 {
					 $ This -> ws = 0;
					 $ This -> _Out (Tw '0 ');
				 }
				 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ i - $ j), $ b, 2, $ alinhar $ preenchimento);
			 }
			 outro
			 {
				 if ($ alinhar == 'J')
				 {
					 $ This -> ws = ($ ns> 1) ($ wmax - $ ls) / 1000 * $ this -> TamanhoDoTipoDeLetra / ($ ns - 1): 0;
					 $ This -> _Out ( sprintf ('% .3 F Tw', $ this -> ws * $ this -> k));
				 }
				 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ setembro - $ j), $ b, 2, $ alinhar $ preenchimento);
				 $ I = $ setembro + 1;
			 }
			 $ Setembro = - 1;
			 $ J = $ i;
			 $ L = 0;
			 $ Ns = 0;
			 $ Nl + +;
			 if ($ && fronteira $ nl == 2)
				 $ B = $ B2;
		 }
		 outro
			 $ I + +;
	 }
	 / / Last pedaço
	 if ($ this -> ws> 0)
	 {
		 $ This -> ws = 0;
		 $ This -> _Out (Tw '0 ');
	 }
	 if ($ fronteira && strpos ($ fronteira, 'b')! == false)
		 $ B = 'B'.;
	 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ i - $ j), $ b, 2, $ alinhar $ preenchimento);
	 $ This -> x = $ this -> lMargin;
 }
 função de gravação ($ h, $ txt, $ link ='')
 {
	 / / Output texto no modo que flui
	 $ Cw = & $ this -> CurrentFont ['cw'];
	 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
	 $ Wmax = ($ w - 2 * $ this -> cMargin) * 1000 / $ this -> FontSize;
	 $ S = str_replace ("\ r",'', $ txt);
	 $ Nb = strlen ($ s);
	 $ Setembro = - 1;
	 $ I = 0;
	 $ J = 0;
	 $ L = 0;
	 $ Nl = 1;
	 while ($ i <$ nb)
	 {
		 / / Pega o próximo caractere
		 $ C = $ s [$ i];
		 if ($ c == "\ n")
		 {
			 / / Quebra de linha explícita
			 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ i - $ j), 0, 2,'', 0, $ link);
			 $ I + +;
			 $ Setembro = - 1;
			 $ J = $ i;
			 $ L = 0;
			 if ($ nl == 1)
			 {
				 $ This -> x = $ this -> lMargin;
				 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
				 $ Wmax = ($ w - 2 * $ this -> cMargin) * 1000 / $ this -> FontSize;
			 }
			 $ Nl + +;
			 continuar;
		 }
		 if ($ c == '')
			 $ Setembro = $ i;
		 $ L + cw = $ [$ c];
		 if ($ l> $ wmax)
		 {
			 / / Quebra de linha automática
			 if ($ setembro == - 1)
			 {
				 if ($ this -> x> $ this -> lMargin)
				 {
					 / / Move para a próxima linha
					 $ This -> x = $ this -> lMargin;
					 $ This -> y + = $ h;
					 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
					 $ Wmax = ($ w - 2 * $ this -> cMargin) * 1000 / $ this -> FontSize;
					 $ I + +;
					 $ Nl + +;
					 continuar;
				 }
				 if ($ i == $ j)
					 $ I + +;
				 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ i - $ j), 0, 2,'', 0, $ link);
			 }
			 outro
			 {
				 $ This -> celular ($ w, $ h, substr ($ s, $ j, $ setembro - $ j), 0, 2,'', 0, $ link);
				 $ I = $ setembro + 1;
			 }
			 $ Setembro = - 1;
			 $ J = $ i;
			 $ L = 0;
			 if ($ nl == 1)
			 {
				 $ This -> x = $ this -> lMargin;
				 $ W = $ this -> w - $ this -> rMargin - $ this -> x;
				 $ Wmax = ($ w - 2 * $ this -> cMargin) * 1000 / $ this -> FontSize;
			 }
			 $ Nl + +;
		 }
		 outro
			 $ I + +;
	 }
	 / / Last pedaço
	 if ($ i! = $ j)
		 $ This -> celular ($ l / 1000 * $ this -> TamanhoDoTipoDeLetra, $ h, substr ($ s, $ j), 0, 0,'', 0, $ link);
 }
 função Ln ($ h = null)
 {
	 / / Alimentação de linha, o valor padrão é altura última célula
	 $ This -> x = $ this -> lMargin;
	 if ($ h === null)
		 $ This -> y + = $ this -> lasth;
	 outro
		 $ This -> y + = $ h;
 }
 função da imagem ($ file, $ x = null, $ y = null, $ w = 0, $ h = 0, $ type ='', $ link ='')
 {
	 / / Coloque uma imagem na página
	 if (! isset ($ this -> imagens [$ file]))
	 {
		 / / Primeiro uso desta imagem, obter informações
		 if ($ type =='')
		 {
			 $ Pos = strrpos ($ arquivo, '.');
			 if (! $ pos)
				 $ This -> Error ('Arquivo de imagem não tem nenhum tipo de extensão e foi especificado:' $ file.);
			 $ Type = substr ($ file, $ pos + 1);
		 }
		 $ Type = strtolower ($ type);
		 if ($ tipo == 'jpeg')
			 $ Type = 'jpg';
		 $ Mtd type = '_parse' $.;
		 if (! method_exists ($ isso, $ MTD))
			 $ This -> erro ('type Unsupported image:' $ tipo.);
		 $ Info = $ this -> $ mtd ($ file);
		 $ Info ['i'] = contagem ($ this -> imagens) + 1;
		 $ This -> imagens [$ file] = $ info;
	 }
	 outro
		 $ Info = $ this -> imagens [$ file];
	 / / Largura e cálculo automático de altura, se necessário
	 if ($ w == 0 && $ h == 0)
	 {
		 / / Coloque imagem de 72 dpi
		 $ W = $ info ['w'] / $ this -> k;
		 $ H = $ info ['h'] / $ this -> k;
	 }
	 elseif ($ w == 0)
		 $ W = $ h * $ info ['w'] / $ info ['h'];
	 elseif ($ h == 0)
		 $ H = $ w * $ info ['h'] / $ info ['w'];
	 Modo / / Flowing
	 if ($ y === null)
	 {
		 {
			 / / Quebra de página automática
			 $ X2 = $ this -> x;
			 $ This -> AddPage ($ this -> CurOrientation, $ this -> CurPageFormat);
			 $ This -> x = $ x2;
		 }
		 $ Y = $ this -> y;
		 $ This -> y + = $ h;
	 }
	 if ($ x === null)
		 $ X = $ this -> x;
	 $ This -> _Out ( sprintf ('q 0,2% F 0 0% 0,2% 0,2 F F% 0,2 cm F / I% d Do Q', $ w * $ this -> k, $ h * $ this -> k , $ x * $ this -> k, ($ this -> h - ($ y + $ h)) * $ this -> k, $ info ['i']));
	 if ($ link)
		 $ This -> Link ($ x, $ y, $ w, $ h, $ link);
 }
 função GetX ()
 {
	 / / Pega a posição x
	 return $ this -> x;
 }
 função SetX ($ x)
 {
	 / / Set posição x
	 if ($ x> = 0)
		 $ This -> x = $ x;
	 outro
		 $ This -> x = $ this -> w + $ x;
 }
 função Gety ()
 {
	 / / Obter posição y
	 return $ this -> y;
 }
 função sety ($ y)
 {
	 / / Set posição y e redefinir x
	 $ This -> x = $ this -> lMargin;
	 if ($ Y> = 0)
		 $ This -> y = $ y;
	 outro
		 $ This -> y = $ this -> h + $ y;
 }
 função SetXY ($ x, $ y)
 {
	 Posições y / / Set x e
	 $ This -> sety ($ y);
	 $ This -> SetX ($ x);
 }
 Saída da função ($ name ='', $ dest ='')
 {
	 / / Output PDF para algum destino
	 if ($ this -> estado <3)
		 $ This -> Close ();
	 $ Dest = strtoupper ($ dest);
	 if ($ dest =='')
	 {
		 if ($ nome =='')
		 {
			 $ Name = 'doc.pdf';
			 $ Dest = 'I';
		 }
		 outro
			 $ Dest = 'F';
	 }
	 switch ($ dest)
	 {
		 case 'I':
			 / / Envia para a saída padrão
			 if ( ob_get_length ())
				 $ This -> Error ('Alguns dados já tem sido de saída, pode \' t enviar arquivo PDF ');
			 if ( php_sapi_name ()! = 'cli')
			 {
				 / / Enviamos para um navegador
				 header ('Content-Type: application / pdf');
				 if ( headers_sent ())
					 $ This -> Error ('Alguns dados já tem sido de saída, pode \' t enviar arquivo PDF ');
				 header ('Content-Length: ". strlen ($ this -> tampão));
				 header ('Content-Disposition: inline; filename = ".. $ name'" ');
				 header ("Cache-Control: private, max-age = 0, deve-revalidar ');
				 header ("Pragma: public ');
				 ini_set ('zlib.output_compression', '0 ');
			 }
			 echo $ this -> tampão;
			 quebrar;
		 case 'D':
			 / / Baixar o arquivo
			 if ( ob_get_length ())
				 $ This -> Error ('Alguns dados já tem sido de saída, pode \' t enviar arquivo PDF ');
			 header ('Content-Type: application / x-download');
			 if ( headers_sent ())
				 $ This -> Error ('Alguns dados já tem sido de saída, pode \' t enviar arquivo PDF ');
			 header ('Content-Length: ". strlen ($ this -> tampão));
			 header ('Content-Disposition: attachment; filename = ".. $ name'" ');
			 header ("Cache-Control: private, max-age = 0, deve-revalidar ');
			 header ("Pragma: public ');
			 ini_set ('zlib.output_compression', '0 ');
			 echo $ this -> tampão;
			 quebrar;
		 case 'F':
			 / / Salvar para arquivo local
			 $ F = fopen ($ name, 'wb');
			 if (! $ f)
				 $ This -> Error ('Não foi possível criar o arquivo de saída:. $ Name);
			 fwrite ($ f, $ this -> buffer, strlen ($ this -> tampão));
			 fclose ($ f);
			 quebrar;
		 case 'S':
			 / / Retorna como string
			 return $ this -> tampão;
		 default:
			 $ This -> Error ('destino incorreto de saída:. $ Dest);
	 }
	 voltar'';
 }
 / ************************************************* ******************************
  **
  * Protegido métodos *
  **
  ************************************************** ***************************** /
 () função _dochecks
 {
	 / / Verifique a disponibilidade de% F
	 if ( sprintf ('% .1 F', 1,0)! = '1 .0 ')
		 $ This -> Error ('Esta versão do PHP não é suportado');
	 / / Check mbstring sobrecarga
	 if ( ini_get ('mbstring.func_overload') & 2)
		 $ This -> Error ('mbstring sobrecarga deve ser desativado');
	 / / Desativar magic quotes em tempo de execução
	 if ( get_magic_quotes_runtime ())
		 @ set_magic_quotes_runtime (0);
 }
 função _getpageformat ($ format)
 {
	 $ Format = strtolower ($ format);
	 if (! isset ($ this -> PageFormats [$ format]))
		 $ This -> Error ('formato desconhecido página:. $ Format);
	 $ A = $ this -> PageFormats [$ format];
	 retorno gama ($ a [0] / $ this -> k, $ a [1] / $ this -> k);
 }
 função _getfontpath ()
 {
	 if (! definidos ('FPDF_FONTPATH') && is_dir ( dirname (__ FILE__). / font '))
		 define ('FPDF_FONTPATH', dirname (__ FILE__) '/ font /'.);
	 voltar definido ('FPDF_FONTPATH')?  FPDF_FONTPATH:'';
 }
 função _beginpage ($ orientação, $ format)
 {
	 $ This -> página + +;
	 $ This -> pages [$ this -> página] ='';
	 $ This -> estado = 2;
	 $ This -> x = $ this -> lMargin;
	 $ This -> y = $ this -> tMargin;
	 $ This -> FontFamily ='';
	 / / Verifica tamanho da página
	 if ($ orientação =='')
		 $ Orientação = $ this -> DefOrientation;
	 outro
		 $ Orientação = strtoupper ($ orientação [0]);
	 if ($ formato =='')
		 $ Format = $ this -> DefPageFormat;
	 outro
	 {
		 if ( is_string ($ format))
			 $ Format = $ this -> _getpageformat ($ format);
	 }
	 {
		 / / New tamanho
		 if ($ orientação == 'P')
		 {
			 $ This -> w = $ formato [0];
			 $ This -> h = $ formato [1];
		 }
		 outro
		 {
			 $ This -> w = $ formato [1];
			 $ This -> h = $ formato [0];
		 }
		 $ This -> WPT = $ this -> w * $ this -> k;
		 $ This -> HPT = $ this -> h * $ this -> k;
		 $ This -> PageBreakTrigger = $ this -> h - $ this -> bMargin;
		 $ This -> CurOrientation = $ orientação;
		 $ This -> CurPageFormat = $ formato;
	 }
		 $ This -> PageSizes [$ this -> página] = matriz ($ this -> WPT, $ this -> HPT);
 }
 função _endpage ()
 {
	 $ This -> estado = 1;
 }
 função _escape ($ s)
 {
	 / / Fuja caracteres especiais em strings
	 $ S = str_replace ('\ \', '\ \ \ \', $ s);
	 $ S = str_replace ('(', '\ \ (', $ s);
	 $ S = str_replace (')', '\ \)', $ s);
	 $ S = str_replace ("\ r", "\ \ r ', $ s);
	 return $ s;
 }
 função _textstring ($ s)
 {
	 / / Formate uma seqüência de texto
	 voltar '(' $ this -> _escape ($ s). '.)';
 }
 função _UTF8toUTF16 ($ s)
 {
	 / / Converte UTF-8 para UTF-16BE com BOM
	 $ Res = "\ xFE \ xFF";
	 $ Nb = strlen ($ s);
	 $ I = 0;
	 while ($ i <$ nb)
	 {
		 $ C1 = ord ($ s [$ i + +]);
		 if ($ c1> = 224)
		 {
			 Personagem / / 3-byte
			 $ C2 = ord ($ s [$ i + +]);
			 $ C3 = ord ($ s [$ i + +]);
			 $ Res =. chr ((($ c1 & 0x0F) << 4) + (($ c2 & 0x3C) >> 2));
			 $ Res =. chr ((($ c2 & 0x03) << 6) + ($ c3 & 0x3F));
		 }
		 elseif ($ c1> = 192)
		 {
			 Personagem / / 2-byte
			 $ C2 = ord ($ s [$ i + +]);
			 $ Res =. chr (($ c1 & 0x1C) >> 2);
			 $ Res =. chr ((($ c1 & 0x03) << 6) + ($ c2 & 0x3F));
		 }
		 outro
		 {
			 / / Personagem Single-byte
			 $ Res = "\ 0".. chr ($ c1);
		 }
	 }
	 return $ res;
 }
 funcionar _dounderline ($ x, $ y, $ txt)
 {
	 / / Sublinhado texto
	 $ Up = $ this -> CurrentFont ['up'];
	 $ Ut = $ this -> CurrentFont ['ut'];
	 $ W = $ this -> GetStringWidth ($ txt) + $ this -> ws * substr_count ($ txt, '');
	 voltar sprintf ('% 0,2% 0,2 F F% 0,2% 0,2 F F re
 }
 função _parsejpg ($ file)
 {
	 / / Extrair informações de um arquivo JPEG
	 $ A = getimagesize ($ arquivo);
	 if (! $ a)
		 $ This -> Error ('file ausentes ou incorretos imagem:. $ File);
	 if ($ a [2]! = 2)
		 $ This -> Error ('Não é um arquivo JPEG:. $ File);
	 if (! isset ($ ['canais'] a) | | $ ['canais'] a == 3)
		 Colspace $ = 'DeviceRGB';
	 (['canais'] $ a == 4) elseif
		 Colspace $ = 'DeviceCMYK';
	 outro
		 Colspace $ = 'DeviceGray';
	 $ Bpc = isset ? ($ a ['bits']) $ a ['bits']: 8;
	 / / Ler arquivo inteiro
	 $ F = fopen ($ arquivo, 'rb');
	 $ Data ='';
	 while (! feof ($ f))
		 $ Dados =. fread ($ f, 8192);
	 fclose ($ f);
	 retorno gama ('w' => $ a [0], 'h' => $ a [1], 'cs' => $ colspace ", bpc '=> $ bpc,' f '=>' DCTDecode ' => $ dados 'data');
 }
 função _parsepng ($ file)
 {
	 / / Extrair informações de um arquivo PNG
	 $ F = fopen ($ arquivo, 'rb');
	 if (! $ f)
		 $ This -> Error ('Can \' t arquivo de imagem em aberto:. $ File);
	 / / Verificação de assinatura
	 if ($ this -> _readstream ($ f, 8) = chr .. (137) 'PNG' chr (13). chr (10). chr (26). chr (10))
		 $ This -> Error ('Não é um arquivo PNG:. $ File);
	 / / Ler pedaço cabeçalho
	 $ This -> _readstream ($ f, 4);
	 if ($ this -> _readstream ($ f, 4) = 'IHDR')
		 $ This -> Error ('arquivo incorreto PNG:. $ File);
	 $ W = $ this -> _readint ($ f);
	 $ H = $ this -> _readint ($ f);
	 $ Bpc = ord ($ this -> _readstream ($ f, 1));
	 if ($ bpc> 8)
		 $ This -> Erro ('16-bit de profundidade não suportados:. $ File);
	 $ Ct = ord ($ this -> _readstream ($ f, 1));
	 if ($ ct == 0)
		 Colspace $ = 'DeviceGray';
	 elseif ($ ct == 2)
		 Colspace $ = 'DeviceRGB';
	 elseif ($ ct == 3)
		 $ Colspace = 'cadastradas';
	 outro
		 $ This -> Error ("canal Alpha não é suportado:. $ File);
	 if ( ord ($ this -> _readstream ($ f, 1)) = 0)
		 $ This -> Error ("método de compressão desconhecida: '$ file.);
	 if ( ord ($ this -> _readstream ($ f, 1)) = 0)
		 $ This -> Error ('método do filtro desconhecida:'. $ File);
	 if ( ord ($ this -> _readstream ($ f, 1)) = 0)
		 $ This -> Error ('entrelaçamento não é suportado:. $ File);
	 $ This -> _readstream ($ f, 4);
	 $ Parms = '/ DecodeParms << / Predictor 15 / Cores' ($ ct == 2 3: 1). '.  / BitsPerComponent. $ Bpc.  / Colunas >> '' $ w. '.;
	 / / Pedaços de digitalização procurando dados paleta, transparência e imagem
	 $ Pal ='';
	 $ TRNS ='';
	 $ Data ='';
	 fazer
	 {
		 $ N = $ this -> _readint ($ f);
		 $ Type = $ this -> _readstream ($ f, 4);
		 if ($ tipo == 'EPDT')
		 {
			 / / Ler paleta
			 $ Pal = $ this -> _readstream ($ f, $ n);
			 $ This -> _readstream ($ f, 4);
		 }
		 elseif ($ tipo == 'Trns')
		 {
			 / / Lê informações transparência
			 $ T = $ this -> _readstream ($ f, $ n);
			 if ($ ct == 0)
				 $ TRNS = gama ( ord ( substr ($ t, 1, 1)));
			 elseif ($ ct == 2)
				 $ TRNS = gama ( ord ( substr ($ t, 1, 1)), ord ( substr ($ t, 3, 1)), ord ( substr ($ t, 5, 1)));
			 outro
			 {
				 $ Pos = strpos ($ t, chr (0));
				 if ($ pos! == false)
					 $ TRNS = gama ($ pos);
			 }
			 $ This -> _readstream ($ f, 4);
		 }
		 elseif ($ tipo == 'IDAT')
		 {
			 / / Ler bloco de dados de imagem
			 $ Data = $ this -> _readstream ($ f, $ n).;
			 $ This -> _readstream ($ f, 4);
		 }
		 elseif ($ tipo == 'IEND')
			 quebrar;
		 outro
			 $ This -> _readstream ($ f, $ n + 4);
	 }
	 while ($ n);
	 if ($ colspace == && 'indexada' vazios $ (pal))
		 $ This -> Error ('paleta Desaparecido em' $ file.);
	 fclose ($ f);
 }
 _readstream função f ($, $ n)
 {
	 / / Ler n bytes do fluxo
	 $ Res ='';
	 while ($ n> 0 &&! feof ($ f))
	 {
		 $ S = fread ($ f, $ n);
		 if ($ s === false)
			 $ This -> Error ("Erro ao ler stream ');
		 $ N - = strlen ($ s);
		 $ Res = $ s.;
	 }
	 if ($ N> 0)
		 $ This -> Error ('Fim inesperado de stream');
	 return $ res;
 }
 função _readint ($ f)
 {
	 / / Lê um inteiro de 4 bytes do fluxo
	 $ A = unpack ('Ni', $ this -> _readstream ($ f, 4));
	 retornar $ a ['i'];
 }
 função _parsegif ($ file)
 {
	 / / Extrair informações de um arquivo GIF (via conversão PNG)
	 if (! function_exists ('imagepng'))
		 $ This -> Error ('extensão GD é necessário para suporte GIF');
	 if (! function_exists ('imagecreatefromgif'))
		 $ This -> Error ('GD não tem suporte GIF leitura');
	 $ Im = imagecreatefromgif ($ file);
	 if (! $ im)
		 $ This -> Error ('file ausentes ou incorretos imagem:. $ File);
	 imageinterlace ($ im, 0);
	 $ Tmp = tempnam ('gif', '.');
	 if (! $ tmp)
		 $ This -> Error ('Não foi possível criar um arquivo temporário');
	 if (! imagepng ($ im, $ tmp))
		 $ This -> Error ('Erro ao salvar em arquivo temporário');
	 imagedestroy ($ im);
	 $ Info = $ this -> _parsepng ($ tmp);
	 unlink ($ tmp);
	 retornar $ info;
 }
 função _newobj ()
 {
	 / / Comece um novo objeto
	 $ This -> n + +;
	 $ This -> offsets [$ this -> n] = strlen ($ this -> buffer);
	 $ This -> _Out ($ this -> n '0 obj.);
 }
 função _putstream ($ s)
 {
	 $ This -> _Out ('stream');
	 $ This -> _Out ($ s);
	 $ This -> _Out ('endstream');
 }
 função _Out ($ s)
 {
	 / / Adiciona uma linha ao documento
	 if ($ this -> estado == 2)
		 $ This -> pages [$ this -> página] = $ s "\ n"..;
	 outro
		 .. $ This -> buffer = $ s "\ n";
 }
 () função _putpages
 {
	 $ Nb = $ ​​this -> página;
	 if (! vazio ($ this -> AliasNbPages))
	 {
		 / / Substituir número de páginas
		 for ($ n = 1; $ n <= $ nb; $ n + +)
			 $ This -> pages [$ n] = str_replace ($ this -> AliasNbPages, $ nb, $ this -> pages [$ n]);
	 }
	 if ($ this -> DefOrientation == 'P')
	 {
		 $ WPT = $ this -> DefPageFormat [0] * $ this -> k;
		 $ HPT = $ this -> DefPageFormat [1] * $ this -> k;
	 }
	 outro
	 {
		 $ WPT = $ this -> DefPageFormat [1] * $ this -> k;
		 $ HPT = $ this -> DefPageFormat [0] * $ this -> k;
	 }
	 $ Filter = ($ this -> compressa) '/ Filter / FlateDecode:?'';
	 for ($ n = 1; $ n <= $ nb; $ n + +)
	 {
		 / / Página
		 $ This -> _newobj ();
		 $ This -> _Out ('<< / Type / Página');
		 $ This -> _Out ('/ Parent 1 0 R');
		 if ( isset ($ this -> PageSizes [$ n]))
			 $ This -> _Out ( sprintf ('/ MediaBox [0 0% 0,2% 0,2 F F]', $ this -> PageSizes [$ n] [0], $ this -> PageSizes [$ n] [1])) ;
		 $ This -> _Out ('/ Recursos 2 0 R');
		 if ( isset ($ this -> pagelinks [$ n]))
		 {
			 / / Ligações
			 $ Annots = '/ Annots [';
			 foreach ($ this -> pagelinks [$ n] quanto $ pl)
			 {
				 $ Rect = sprintf ('% 0,2% 0,2 F F% 0,2% 0,2 F F', $ pl [0], $ pl [1], $ pl [0] + $ pl [2], $ pl [1] - PL $ [3]);
				 . $ Annots = '<< / Type / Annot / subtipo / ligação / Rect ['. $ Rect. '] / Border [0 0 0]';
				 if ( is_string ($ pl [4]))
					 $ Annots = '/ A << / S / URI / URI' $ this -> _textstring ($ pl [4]) '>>>>'...;
				 outro
				 {
					 $ L = $ this -> ligações [$ pl [4]];
					 $ H = isset ($ this -> PageSizes [$ l [0]]) $ this -> PageSizes [$ l [0]] [1]:? $ HPT;
					 $ Annots =. sprintf ('/ Dest [% d 0 R / XYZ 0% 0,2 F nulo] >>', 1 + 2 * $ l [0], $ h - $ l [1] * $ this -> k );
				 }
			 }
			 $ This -> _Out ($ annots '] ").;
		 }
		 $ This -> _Out ('/ Contents "($ this -> n + 1)' 0 R >> '..);
		 $ This -> _Out ('endobj');
		 / / Página conteúdo
		 ? $ P = ($ this -> compressa) gzcompress ($ this -> pages [$ n]): $ this -> pages [$ n];
		 $ This -> _newobj ();
		 $ This -> _Out ('<<' $ filter '/ Length'... strlen ($ p) '>>'.);
		 $ This -> _putstream ($ p);
		 $ This -> _Out ('endobj');
	 }
	 / / Pages raiz
	 $ This -> offsets [1] = strlen ($ this -> buffer);
	 $ This -> _Out ('1 0 obj ');
	 $ This -> _Out ('<< / Type / Pages');
	 $ Kids = '/ Kids [';
	 for ($ i = 0; $ i <$ nb; $ i + +)
		 $ Filhos. = (3 + 2 * $ i).  0 R ';
	 $ This -> _Out ($ kids '] ").;
	 $ This -> _Out ('/ Count' $ nb.);
	 $ This -> _Out ( sprintf ('/ MediaBox [0 0% 0,2% 0,2 F F]', $ WPT $ HPT));
	 $ This -> _Out ('>>');
	 $ This -> _Out ('endobj');
 }
 () função _putfonts
 {
	 $ Nf = $ this -> n;
	 foreach ($ this -> diffs como $ diff)
	 {
		 / / Codificações
		 $ This -> _newobj ();
		 $ This -> _Out ('<< / Type / codificação / BaseEncoding / WinAnsiEncoding / Diferenças' >> ['$ diff.].');
		 $ This -> _Out ('endobj');
	 }
	 foreach ($ this -> FontFiles quanto $ arquivo => $ info)
	 {
		 / Incorporação arquivo / Font
		 $ This -> _newobj ();
		 $ This -> FontFiles [$ file] ['n'] = $ this -> n;
		 $ Font ='';
		 $ F = fopen ($ this -> _getfontpath () $ arquivo, 'rb', 1.);
		 if (! $ f)
			 $ This -> Error ('file Font não encontrado');
		 while (! feof ($ f))
			 $ Font =. fread ($ f, 8192);
		 fclose ($ f);
		 $ Comprimido = ( substr ($ file, - 2) == 'z.');
		 if (! $ comprimido && isset ($ info ['length2']))
		 {
			 $ Header = ( ord ($ fonte [0]) == 128);
			 if ($ header)
			 {
				 / / Tira primeiro cabeçalho binário
				 $ Font = substr ($ fonte, 6);
			 }
			 if ($ header && ord ($ fonte [$ info ['length1']]) == 128)
			 {
				 / / Faixa de cabeçalho segundo binário
				 $ Font = substr ($ fonte, 0, $ info ['length1']). substr ($ fonte, $ info ['length1'] + 6);
			 }
		 }
		 $ This -> _Out ('<< / Length. strlen ($ fonte));
		 if ($ comprimido)
			 $ This -> _Out ('/ Filter / FlateDecode');
		 $ This -> _Out ('/ Comprimento 1' $ info ['length1'].);
		 if ( isset ($ info ['length2']))
			 $ This -> _Out ('/ length2' $ info ['length2'] '/ length3 0'..);
		 $ This -> _Out ('>>');
		 $ This -> _putstream ($ fonte);
		 $ This -> _Out ('endobj');
	 }
	 foreach ($ this -> fontes como $ k => $ fonte)
	 {
		 / / Objetos Font
		 $ This -> fontes [$ k] ['n'] = $ this -> n + 1;
		 $ Type = $ fonte ['type'];
		 $ Name = $ fonte ['name'];
		 if ($ tipo == 'core')
		 {
			 / / Font padrão
			 $ This -> _newobj ();
			 $ This -> _Out ('<< / Type / Font');
			 $ This -> _Out ('/ BASEFONT /' $ name.);
			 $ This -> _Out ('/ subtipo / Tipo 1');
			 if ($ name! = 'Símbolo' && $ nome! = 'ZapfDingbats')
				 $ This -> _Out ('/ codificação / WinAnsiEncoding');
			 $ This -> _Out ('>>');
			 $ This -> _Out ('endobj');
		 }
		 elseif ($ tipo == 'Type 1' | | $ tipo == 'TrueType')
		 {
			 / / Tipo1 adicionais ou fonte TrueType
			 $ This -> _newobj ();
			 $ This -> _Out ('<< / Type / Font');
			 $ This -> _Out ('/ BASEFONT /' $ name.);
			 $ This -> _Out ('/ subtipo /' $ tipo.);
			 $ This -> _Out ('/ FirstChar 32 / lastchar 255');
			 $ This -> _Out ('/ larguras' ($ this -> n + 1) 'R'. 0.);
			 $ This -> _Out ('/ FontDescriptor' ($ this -> n + 2) '0 R'..);
			 if ($ fonte ['enc'])
			 {
				 if ( isset ($ fonte ['diff']))
					 $ This -> _Out ('/ Encoding' ($ nf + $ fonte ['diff']) '0 R'..);
				 outro
					 $ This -> _Out ('/ codificação / WinAnsiEncoding');
			 }
			 $ This -> _Out ('>>');
			 $ This -> _Out ('endobj');
			 / / Larguras
			 $ This -> _newobj ();
			 $ Cw = & $ fonte ['cw'];
			 $ S = '[';
			 for ($ i = 32; $ i <= 255; $ i + +)
				 $ S. = $ Cw [ chr ($ i)].  ';
			 $ This -> _Out ($ s '].');
			 $ This -> _Out ('endobj');
			 / / Descritor
			 $ This -> _newobj ();
			 $ S = '<< / Type / FontDescriptor / NomeDaFonte /' $ name.;
			 foreach ($ fonte ['desc'] quanto $ k => $ v)
				 $ S. = '/'. $ K.  '$ V.;
			 $ Arquivo = $ fonte ['arquivo'];
			 if ($ file)
				 . $ S = '/ fontfile' ($ tipo == 'Type 1''':? '2 ').'.  '$ This -.> FontFiles [$ file] [' n '].'  0 R ';
			 $ This -> _Out ($ s '>>'.);
			 $ This -> _Out ('endobj');
		 }
		 outro
		 {
			 / / Permitir a outros tipos
			 $ Mtd = '_put. strtolower ($ type);
			 if (! method_exists ($ isso, $ MTD))
				 $ This -> Error ('tipo não suportado fonte:. $ Type);
			 $ This -> $ mtd ($ fonte);
		 }
	 }
 }
 () função _putimages
 {
	 $ Filter = ($ this -> compressa) '/ Filter / FlateDecode:?'';
	 resetar ($ this -> imagens);
	 while ( lista ($ file, $ info) = cada ($ this -> imagens))
	 {
		 $ This -> _newobj ();
		 $ This -> imagens [$ file] ['n'] = $ this -> n;
		 $ This -> _Out ('<< / Type / XObject');
		 $ This -> _Out ('/ subtipo / Imagem');
		 $ This -> _Out ('/ Largura' $ info ['w'].);
		 $ This -> _Out ('/ Altura' $ info ['h'].);
		 if ($ info ['cs'] == 'cadastradas')
			 $ This -> _Out ('/ ColorSpace [/ indexado / DeviceRGB' (. strlen ($ info ['amigo']) / 3 - 1) '.' ($ this -..> n + 1) '0 R] ');
		 outro
		 {
			 $ This -> _Out ('/ ColorSpace /' $ info ['cs'].);
			 if ($ info ['cs'] == 'DeviceCMYK')
				 $ This -> _Out ('/ Decode [1 0 1 0 1 0 1 0]');
		 }
		 $ This -> _Out ('. / BitsPerComponent' $ info ['bpc']);
		 if ( isset ($ info ['f']))
			 $ This -> _Out ('/ Filter /' $ info ['f'].);
		 if ( isset ($ info ['parms']))
			 $ This -> _Out ($ info ['parms']);
		 if ( isset ($ info ['TRNS']) && is_array ($ info ['TRNS']))
		 {
			 $ TRNS ='';
			 for ($ i = 0; $ i <count ($ info ['TRNS']); $ i + +)
				 $ TRNS. = $ Info ['TRNS'] [$ i]. "  . $ Info ['TRNS'] [$ i]. "  ';
			 $ This -> _Out ('/ Máscara [' $. TRNS. ']');
		 }
		 $ This -> _Out ('/ comprimento. strlen ($ info ['data']) '>>'.);
		 $ This -> _putstream ($ info ['data']);
		 unset ($ this -> imagens [$ file] ['data']);
		 $ This -> _Out ('endobj');
		 / / Paleta
		 if ($ info ['cs'] == 'cadastradas')
		 {
			 $ This -> _newobj ();
			 ? $ Pal = ($ this -> compressa) gzcompress ($ info ['amigo']): $ info ['amigo'];
			 $ This -> _Out ('<<' $ filter '/ Length'... strlen ($ pal) '>>'.);
			 $ This -> _putstream ($ pal);
			 $ This -> _Out ('endobj');
		 }
	 }
 }
 função _putxobjectdict ()
 {
	 foreach ($ this -> imagens como $ image)
		 $ This -> _Out ('/ I' $ imagem ['i'] '[n']. '0 R'.. $ Imagem. ');
 }
 função _putresourcedict ()
 {
	 $ This -> _Out ('/ ProcSet [/ PDF / Texto / ImageB / ImageC / ImageI]');
	 $ This -> _Out ('/ Font <<');
	 foreach ($ this -> fontes como fonte $)
		 $ This -> _Out ('/ F' $ fonte ['i'] '[n']. '0 R'.. $ Fonte. ');
	 $ This -> _Out ('>>');
	 $ This -> _Out ('/ XObject <<');
	 $ This -> _putxobjectdict ();
	 $ This -> _Out ('>>');
 }
 funcionar _putresources ()
 {
	 $ This -> _putfonts ();
	 $ -> Este _putimages ();
	 / / Resource dicionário
	 $ This -> offsets [2] = strlen ($ this -> buffer);
	 $ This -> _Out ('2 0 obj ');
	 $ This -> _Out ('<<');
	 $ This -> _putresourcedict ();
	 $ This -> _Out ('>>');
	 $ This -> _Out ('endobj');
 }
 função _putinfo ()
 {
	 $ This -> _Out ('/ Producer' $ this -> _textstring ("FPDF" FPDF_VERSION)..);
	 if (! vazio ($ this -> title))
		 $ This -> _Out ('/ Título' $ this -> _textstring ($ this -> título).);
	 if (! vazio ($ this -> assunto))
		 $ This -> _Out ('/ Assunto' $ this -> _textstring ($ this -> objeto).);
	 if (! vazio ($ this -> autor))
		 $ This -> _Out ('/ Author' $ this -> _textstring ($ this -> autor).);
	 if (! vazio ($ this -> palavras-chave))
		 $ This -> _Out ('/ Palavras-chave' $ this -> _textstring ($ this -> palavras-chave).);
	 if (! vazio ($ this -> criador))
		 $ This -> _Out ('/ Criador' $ this -> _textstring ($ this -> criador).);
	 $ This -> _Out ('/ CreationDate' $ this -> _textstring ('D:'.. @ data ('YmdHis')));
 }
 função _putcatalog ()
 {
	 $ This -> _Out ('/ Tipo / catálogo');
	 $ This -> _Out ('/ Pages 1 0 R');
	 if ($ this -> ZoomMode == 'fullpage')
		 $ This -> _Out ('/ OpenAction [3 0 R / Fit]');
	 elseif ($ this -> ZoomMode == 'fullwidth')
		 $ This -> _Out ('/ OpenAction [3 0 R / Fith nulo]');
	 elseif ($ this -> ZoomMode == 'real')
		 $ This -> _Out ('/ OpenAction [3 0 R / XYZ null null 1]');
	 elseif (! is_string ($ this -> ZoomMode))
		 $ This -> _Out ('/ OpenAction [3 0 R / XYZ null null' ($ presente -> ZoomMode / 100). '.]');
	 if ($ this -> LayoutMode == 'single')
		 $ This -> _Out ('/ PageLayout / SinglePage');
	 elseif ($ this -> LayoutMode == 'contínuo')
		 $ This -> _Out ('/ PageLayout / OneColumn');
	 elseif ($ this -> LayoutMode == 'dois')
		 $ This -> _Out ('/ PageLayout / TwoColumnLeft');
 }
 função _putheader ()
 {
	 $ This -> _Out ('% PDF-' $ this -> PDFVersion.);
 }
 função _puttrailer ()
 {
	 $ This -> _Out ('/ Size' ($ this -> n + 1).);
	 $ This -> _Out ('/ root' $ this -> n '0 R'..);
	 $ This -> _Out ('/ Info' ($ this -> n - 1) "0 R '..);
 }
 função _enddoc ()
 {
	 $ This -> _putheader ();
	 $ This -> _putpages ();
	 $ This -> _putresources ();
	 / / Informações
	 $ This -> _newobj ();
	 $ This -> _Out ('<<');
	 $ This -> _putinfo ();
	 $ This -> _Out ('>>');
	 $ This -> _Out ('endobj');
	 / / Catálogo
	 $ This -> _newobj ();
	 $ This -> _Out ('<<');
	 $ This -> _putcatalog ();
	 $ This -> _Out ('>>');
	 $ This -> _Out ('endobj');
	 / / Cross-ref
	 $ O = strlen ($ this -> buffer);
	 $ This -> _Out ('xref');
	 $ This -> _Out ('0 '($ this -> n + 1).);
	 $ This -> _Out ('0000000000 65535 f ');
	 for ($ i = 1; $ i <= $ this -> n; $ i + +)
		 $ This -> _Out ( sprintf ('% 010D 00000 n', $ this -> offsets [$ i]));
	 / / Trailer
	 $ This -> _Out ('reboque');
	 $ This -> _Out ('<<');
	 $ This -> _puttrailer ();
	 $ This -> _Out ('>>');
	 $ This -> _Out ('startxref');
	 $ This -> _Out ($ o);
	 $ This -> _Out ('%% EOF');
	 $ This -> estado = 3;
 }
 / / Fim da classe
 }
 / / Handle pedido especial contype IE
 if ( isset ($ _SERVER ['HTTP_USER_AGENT']) && $ _SERVER ['HTTP_USER_AGENT'] == 'contype')
 {
	 header ('Content-Type: application / pdf');
	 exit ;
 }
 
