<?php

/**
 *
 *  General functions
 *
 */

use Carbon\Carbon;

if(!function_exists('set_filename_random'))
{
    function set_filename_random($length = 30)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if(!function_exists('convertdata_todb'))
{
    function convertdata_todb($data)
    {
        return (Carbon::createFromFormat('d/m/Y', $data)->format('Y-m-d'));
    }
}
if(!function_exists('convertdata_like'))
{
    function convertdata_like($data)
    {
        return (Carbon::createFromFormat('Y-m', $data)->format('Y-m-d H:i:s'));
    }
}

if(!function_exists('convertdata_tosite'))
{
    function convertdata_tosite($data, $time=TRUE)
    {
//        return (Carbon::parse($data)->format('d/m/Y' . ($time ? ' H:i:s' : '')));
        return (Carbon::parse($data)->format('d/m/Y' . ($time ? '' : '')));
    }
}

if(!function_exists('sanitizeString'))
{
    function sanitizeString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)

        return $str;
    }
}

if(!function_exists('getServices'))
{
    function getServices() {
        return [
        [
            'title'     => 'Arquivologia',
            'icon'      => 'icone-cedoc',
            'subtitle'  => 'Os princípios e técnicas',
            'content'   => '<p>O princípios e técnicas específicas para arquivar, conservar, organizar e guardar documentos de forma que sejam fáceis de encontrar.</p>
                <p>Conservar e Restaurar​: Prevenir a deterioração de documentos, evitando a perda de informações com o passar do tempo.</p>
                <p><strong>Prestar consultoria​:</strong> Orientar empresas sobre como manter e organizar o arquivo de forma que fique fácil manusear e consultar a documentação.</p>
                <p><strong>Documentos Eletrônicos​:</strong> A documentação eletrônica também é algo que deve ser conservado. A arquivologia fica responsável por criar um banco de dados, fazer microfilmagem e/ou digitalizar documentos.</p>
                <p><strong>Gerenciar conteúdo​:</strong> O arquivista também pode ser o responsável por selecionar os documentos importantes, podendo assim decidir qual deve ser armazenado e qual pode ser destruído, evitando o acúmulo de documentos desnecessários.</p>
                <p><strong>Mapear e transcrever arquivos​:</strong> A principal atribuição dessa função é fazer a classificação e mapear os documentos para facilitar sua localização.</p>
                <p>A restauração de arquivos danificados é feito pelo arquivista, com a digitação de toda a documentação e anexando a fotocópia do original.</p>'
        ],
        [
            'title'     => 'Gestão Patrimonial',
            'icon'      => 'icone-terceirizacao',
            'subtitle'  => 'Gerenciamento eficiente',
            'content'   => '<p>Realizar a gestão patrimonial de uma empresa de forma eficiente e controlada traz muitos ganhos, como otimização de custos, maior controle dos bens e melhora no aproveitamento de instalações e equipamentos. Por isso, ela é extremamente importante para o ambiente organizacional, devendo ter destaque na administração de uma companhia.</p>

                <p>Um gerenciamento ineficiente nesse campo também pode resultar em acúmulo de materiais dispensáveis, manutenção de itens obsoletos ou defasados e aumento desnecessário do ativo imobilizado.</p>

                <p><strong>O que é patrimônio?</strong></p>

                <p>O primeiro ponto é entender o conceito de patrimônio, que está relacionado aos bens, obrigações e direitos de uma organização ou pessoa. Há também o patrimônio familiar, que tem a ver com o que uma família possui, e o patrimônio público, pertencente ao povo em geral.</p>

                <p>No nosso caso, focaremos no aspecto empresarial, ou seja, naquilo que é da empresa.</p>

                <p><strong>O que são bens?</strong></p>

                <p>Para tanto, é preciso entender que os bens são aqueles itens que possuem valor econômico para o negócio, isto é, que podem ser transformados em dinheiro. Eles podem ser classificados em diferentes tipos (às vezes em dois ou mais deles) conforme suas características mais marcantes, tais como:</p>

                <ul>
                    <li>
                    <p>bens tangíveis &mdash; são os itens que têm forma física e podem ser mais facilmente mensurados, como equipamentos, maquinários, mercadorias e insumos em estoque, entre outros;</p>
                    </li>
                    <li>
                    <p>bens intangíveis &mdash; aquilo que não conta com forma física, mas tem valor para a empresa. Por exemplo: marca, direitos autorais, patentes etc.;</p>
                    </li>
                    <li>
                    <p>bens imóveis &mdash; são os objetos que não podem ser movidos, como instalações físicas, terrenos e construções (casas, apartamentos, prédios). Eles são vinculados ao solo em que se encontram, sendo dificilmente retirados para outras áreas;</p>
                    </li>
                    <li>
                    <p>bens móveis &mdash; são os itens que podem ser movidos de um local a outro, não perdendo suas qualidades e nem sofrendo avarias. Os exemplos mais comuns são veículos, equipamentos de produção e a mobília;</p>
                    </li>
                    <li>
                    <p>bens numerários &mdash; corresponde aos valores monetários da empresa, ou seja, ao dinheiro disponível em caixa ou em contas nos bancos;</p>
                    </li>
                    <li>
                    <p>bens de consumo &mdash; se empregados no processo produtivo, designam materiais usados para a manutenção, conservação, limpeza etc. Entre eles, temos os produtos de higienização, combustível e materiais administrativos;</p>
                    </li>
                </ul>
                <ul>
                    <li>
                    <p>bens de venda &mdash; produtos para comercialização, estando eles nas lojas ou em estoque;</p>
                    </li>
                    <li>
                    <p>bens primários &mdash; itens que não sofreram modificações ou transformações, geralmente insumos, como minérios;</p>
                    </li>
                    <li>
                    <p>bens intermediários &mdash; são fabricados e usados na produção de outros bens, não ficando disponíveis para o consumo final. Um exemplo é o tecido empregado em outros objetos usados nas indústrias. No entanto, o tecido feito para a venda direta aos clientes não entra nesse tipo;</p>
                    </li>
                    <li>
                    <p>bens de produção ou de capital &mdash; também são empregados para a produção de outros bens, mas sendo eles os responsáveis diretos por isso. Por exemplo, máquinas e equipamentos;</p>
                    </li>
                </ul>
                <p>bens finais &mdash; mercadorias prontas para o consumo, também sendo classificadas como bens de consumo quando orientadas para a venda. Podem ser duráveis, não-duráveis (alimentos e outros perecíveis) e semiduráveis (que se desgastam com o uso, como uniformes).</p>

                <p><strong>Por que realizar a gestão patrimonial?</strong></p>

                <p>A gestão patrimonial é importante para as empresas porque ajuda a manter sob controle os custos relacionados aos bens e obrigações do negócio, além de facilitar a administração dos direitos da organização. Ela também permite a correta mensuração dos estoques, dos itens pertencentes ao empreendimento e dos níveis de obsolência, defasagem ou depreciação dos equipamentos.</p>

                <p>A gestão patrimonial conta com um instrumento importante para a correta análise dos três itens acima citados: o Balanço Patrimonial (BP). Esse demonstrativo é fundamental para orientar o gestor da área e também os líderes dos setores administrativo, financeiro, contábil, entre outros.</p>

                <p>Com a ajuda dele, a gestão do patrimônio pode ser feita com maior eficiência e controle. Desse modo, ela permite saber o montante e a quantidade dos ativos (direitos e bens) e dos passivos (obrigações e dívidas) da companhia.</p>

                <p>Ainda facilita a obtenção de informações sobre o patrimônio construído e acumulado ao longo dos anos, o que permite entender se a organização está crescendo, se encontra-se estagnada ou se há declínio em suas operações.</p>

                <p>A gestão patrimonial também é importante para a própria credibilidade da empresa, pois, sem ela, os resultados financeiros do negócio podem ser comprometidos ou colocados em</p>

                <p>dúvida. Portanto, o correto controle do patrimônio é essencial também para a transparência das operações do empreendimento junto ao governo, aos parceiros e demais ​stakeholders.​</p>

                <p>Como visto, não se deve descuidar desse processo, não só pelo exposto, mas também porque ele facilita a execução de outros procedimentos financeiros, como o planejamento orçamentário. Esse, por sua vez, pode ser feito com maior precisão quando considerados os dados fornecidos pelas atividades de controle do patrimônio.</p>

                <p>Isso porque os bens, obrigações e direitos qualificados e quantificados em determinado período permitem a previsão dos recursos que entrarão ou serão necessários no período subsequente. Basicamente, as estimativas orçamentárias passam a ter como base as necessidades reais da empresa.</p>

                <p><strong>Quais os benefícios da gestão patrimonial?</strong></p>

                <p>De forma mais específica, é possível dizer que a gestão adequado do patrimônio é capaz de gerar importantes benefícios para a empresa, como a descoberta do valor real da companhia. Isso graças ao controle e ao levantamento de seus bens, direitos e obrigações.</p>

                <p>Outras</p>

                <p>vantagens incluem:</p>

                <ul>
                    <li>
                    <p>a produção de demonstrativos e balanços mais acertados, auxiliando a diretoria e os gerentes no processo de tomada de decisões;</p>
                    </li>
                    <li>
                    <p>maior adequação às imposições legais e governamentais relacionadas ao controle patrimonial;</p>
                    </li>
                    <li>
                    <p>evitar o direcionamento de recursos à aquisição de bens desnecessários;</p>
                    </li>
                    <li>
                    <p>melhora na identificação das necessidades de equipamentos e maquinários, possibilitando a realização de investimentos adequados para aquisição ou manutenção desses ativos;</p>
                    </li>
                    <li>
                    <p>maior proteção contra extravios, roubos e desvios de recursos, pois todo o patrimônio da empresa passa a ser corretamente identificado e registrado;</p>
                    </li>
                    <li>
                    <p>atendimento aos requisitos e exigências de instituições financeiras caso seja preciso buscar crédito junto a elas;</p>
                    </li>
                    <li>
                    <p>permite uma otimização do gerenciamento de riscos, já que os bens identificados e listados podem ser melhor segurados. Afinal, sem uma boa gestão do patrimônio, você poderá não saber exatamente quais os bens da empresa e sem esse conhecimento dificilmente conseguirá protegê-los;</p>
                    </li>
                    <li>
                    <p>o apoio dado ao processo orçamentário facilita a redução de recursos e investimentos mal empregados. Aliás, é possível fazer estimativas até sobre o tempo de utilização e a vida útil de maquinários, o que ajuda a evitar aplicar recursos caso eles estejam bons ainda;</p>
                    </li>
                </ul>

                <p>prevenção de problemas com o fisco, especialmente por omissões de receita e ganhos obtidos com vendas de bens imobilizados. Isso pode gerar multas, processos administrativos/fiscais e outras sanções por parte da Receita Federal e de outros órgãos do governo.</p>

                <p><strong>Quais são as etapas da gestão patrimonial?</strong></p>

                <p>A gestão patrimonial pode ser posta em prática por meio de etapas, embora isso possa variar de empresa para empresa, de acordo com o setor e as características do empreendimento. Mas, em geral, ela pode seguir a seguinte estrutura:</p>

                <p><strong>1. Adoção de sistemas de apoio</strong></p>

                <p>Para começar, lembre-se de buscar uma ferramenta tecnológica para ajudar na realização do controle patrimonial. Com o uso de um sistema da área, dá para otimizar as etapas seguintes desse processo, já que ele entrega maior agilidade na execução de procedimentos de controle de ativo fixo, correção monetária e catalogação de bens.</p>

                <p>Um software do tipo é capaz de manter, de modo estruturado, todas as informações relevantes da gestão patrimonial, organizando-as em relatórios úteis para os gestores. Ele também deve ter boa integração com soluções contábeis para ajudar a produzir demonstrativos e outros documentos necessários para a área, como:</p>

                <ul>
                    <li>
                    <p>Balanços Patrimoniais;</p>
                    </li>
                    <li>
                    <p>baixas do ativo imobilizado;</p>
                    </li>
                    <li>
                    <p>relatórios das depreciações;</p>
                    </li>
                    <li>
                    <p>balancetes de cada período;</p>
                    </li>
                    <li>
                    <p>listagem com os bens por filiais ou grupos;</p>
                    </li>
                    <li>
                    <p>análise de despesas, receitas ou resultados relacionados ao patrimônio etc.</p>
                    </li>
                </ul>

                    <p><strong>2. Levantamento do inventário dos bens do empreendimento</strong></p>

                    <p>Após escolher um bom software, é preciso realizar uma listagem de todos os ativos da organização. Aqui pode ser feito um levantamento dos bens com posterior identificação deles por meio de placas, adesivos ou fichas.</p>

                <p>Também é indicado realizar registros fotográficos e descrições sobre suas características e localizações dentro das dependências da empresa.</p>

                <p>No entanto, é preciso destacar que essa fase precisa ser feita constantemente para checagem dos materiais registrados, pois, ao longo do tempo, os objetos podem ser mudados de lugar, vendidos ou alienados. Inclusive outros podem ser adquiridos e postos no lugar dos descartados.</p>

                <p><strong>3. Análise dos ativos existentes</strong></p>

                <p>Nessa fase acontece a verificação e identificação do valor de cada bem, avaliando-se o valor justo, que é o que ele vale no momento, e o residual, o que se espera que ele chegue a valer no final de sua vida útil.</p>

                <p>Também se observa o custo de reposição dele, pois será preciso, no momento ou em um período futuro, trocá-lo para que o processo ligado a ele continue sendo realizado.</p>

                <p><strong>4. Avaliação da vida útil dos bens</strong></p>

                <p>É importante analisar e revisar a vida útil de cada bem do negócio, para que seja possível estimar até quando se poderá contar com ele. É aqui que se analisa a vida útil econômica, ou seja, o tempo em que se poderá empregá-lo, e a vida útil transcorrida &mdash; o período em que ele já foi usado.</p>

                <p>É preciso ficar atento em relação à condição de cada bem para checar se sua vida útil não foi reduzida em virtude de má conservação, sobrecarga ou negligência. Caso seja constatado que ocorreu algo assim, você poderá planejar formas melhores de, futuramente, manter e acondicionar não só esse bem, como outros.</p>

                <p><strong>5. Atualização dos bens do inventário</strong></p>

                <p>É preciso executar a atualização dos valores monetários de cada item de seu patrimônio para que, desse modo, haja um controle e monitoramento mais efetivo das &ldquo;peças&rdquo; que compõem o seu negócio. Desse modo, é preciso fazer a contabilização da depreciação dos itens presentes na companhia em seu imobilizado.</p>

                <p><strong>6. Conciliação entre os aspectos físicos e contábeis</strong></p>

                <p>Nessa etapa é feita uma comparação das informações existentes na base contábil com os dados constantes no inventário físico. É aqui que serão identificados os itens contabilizados, porém que não constam fisicamente nos inventários da companhia. Também é nessa fase que se observa os bens que não têm registro contábil, embora estejam na organização.</p>

                <p>Dessa conciliação resultam alguns relatórios, como o de sobras físicas, o de bens conciliados e o de sobras contábeis. Normalmente, algumas companhias realizam, depois dessas etapas, o chamado Teste de Impairment ou Teste de Recuperabilidade do Ativo. Ele procura avaliar se os ativos do negócio encontram-se desvalorizados.</p>

                <p>O propósito desse teste é garantir que o valor contábil registrado de um bem possa ser recuperável pela sua capacidade de produzir dinheiro, ou receita, o que é feito por meio de sua comercialização ou utilização.</p>

                <p>Vale destacar que o Teste de Impairment está de acordo com as Normas Contábeis Brasileiras (CPC01). Além disso, conforme a Lei No. 11.638/07, é obrigatório para sociedades empresariais consideradas de grande porte a análise em relação à recuperação de valores que foram registrados no imobilizado da empresa.</p>

                <p>Enquadram-se nisso as organizações que conseguiram, no exercício anterior, receita bruta anual maior que R$ 300 milhões ou ativo total superior a R$ 240 milhões.</p>

                <p><strong>Por que contratar um gestor patrimonial?</strong></p>

                <p>O controle do inventário e das obrigações/direitos da empresa não é uma tarefa fácil, demandando bastante trabalho e empenho. Por isso, é importante contratar um gestor patrimonial experiente para ser encarregado desse serviço.</p>

                <p>Como está envolvido diretamente com o gerenciamento de bens, direitos e obrigações, ele é capaz de ajudar outros líderes do negócio. Inclusive, tem chances de realizar uma recomendação personalizada de investimentos tendo por base as necessidades e condições reais da empresa.</p>

                <p>Sendo assim, a alocação de ativos passará a ser feita com maior eficiência e precisão, o que, futuramente, poderá trazer melhores resultados para o empreendimento.</p>

                <p>É preciso destacar que o gestor patrimonial é um profissional de confiança, sendo responsável pela análise, assessoria e gerenciamento dos bens do negócio, o que inclui recursos e investimentos. Uma de suas atribuições é pensar em estratégias que possam aumentar o patrimônio corporativo, colaborando, dessa forma, com a própria gestão da empresa.</p>

                <p>Ele também ficará envolvido no dimensionamento de riscos que possam afetar o inventário e no planejamento de soluções que evitam ou resolvem eventuais problemas relacionados a ele. Esse profissional ainda será encarregado de definir prioridades e objetivos visando ao aproveitamento de oportunidades do mercado, tudo isso sem deixar de proteger o patrimônio empresarial.</p>

                <p><strong>Quais as consequências de não realizar o controle patrimonial?</strong></p>

                <p><strong>Falta de informação sobre a depreciação do patrimônio</strong></p>

                <p>Sem um bom controle patrimonial fica difícil saber o quanto de depreciação atingiu cada bem do inventário, o que pode gerar dificuldades na mensuração de custos e despesas operacionais.</p>

                <p>Em relação ao Balanço Patrimonial, é preciso destacar que os ativos imobilizados contabilizados têm seus registros feitos em correspondência aos seus valores de aquisição, dos quais se descontam percentuais de depreciação, amortização ou exaustão.</p>

                <p>O montante de depreciação de cada bem precisa ser lançado periodicamente, em sucessão nas contas de depreciação. Isso é feito até que ocorra a depreciação total, o item chegar à obsolescência ou desgaste completo.</p>

                <p>É necessário destacar que o procedimento de desgaste de cada bem é computado todo ano em contas acumuladoras de saldo. Dessa forma, o processo continua com esses valores sendo contabilizados pela empresa como custo de despesa operacional.</p>

                <p>No entanto, quando o bem atinge a depreciação total (momento em que a depreciação chega a 100%), porém ele ainda existe e pode ser usado, o ativo é baixado contabilmente ao se executar sua doação, venda ou finalização de serventia. Vale destacar que a depreciação é caracterizada como despesa operacional sem desembolso.</p>

                <p><strong>Inadequações à lei</strong></p>

                <p>Como visto, manter uma boa gestão patrimonial é essencial para a empresa ficar em conformidade com os órgãos de fiscalização do governo. Se ela não faz isso, poderá ter problemas com o fisco, o que gerará sanções, multas, processos etc.</p>

                <p>Por isso, é importante manter o correto controle patrimonial, com um adequado detalhamento de informações e otimização do controle dos itens do inventário. Tudo isso observando atentamente os dispostos na já mencionada Lei 11.638/7.</p>

                <p>Uma boa gestão patrimonial permite identificar e gerir corretamente os bens do negócio. Além disso, possibilita aos líderes da empresa, com base em sua situação e nos recursos físicos/monetários existentes, delimitar o melhor investimento hoje, amanhã e para os próximos anos. Tudo isso com maiores chances de êxito.</p>

                <p>A correta mensuração do inventário, das obrigações e dos direitos do empreendimento também melhora a tomada de decisões e fornece aos gestores informações valiosas para a condução da companhia. Dessa forma, os líderes deixam de gerenciar os recursos e ativos corporativos &ldquo;no escuro&rdquo; e conseguem traçar rumos com base em relatórios mais precisos.</p>

                <p>Por fim, vale destacar que a gestão patrimonial não se resume apenas a controle de itens do inventário, uma vez que tem grande papel na administração de investimentos que podem ser feitos no negócio ou em ativos do mercado. Dessa forma, ela colabora também para o aumento dos resultados do empreendimento por meio de ganhos com aplicações e títulos.</p>
'
        ],
        [
            'title'     => 'Auditoria',
            'icon'      => 'icone-gerenciamento',
            'subtitle'  => 'Conceitos e Objetivos',
            'content'   => '<p>Uma auditoria é uma revisão das demonstrações financeiras, sistema financeiro, registros, transações e operações de uma entidade ou de um projeto, efetuada por contadores, com a finalidade de assegurar a fidelidade dos registros ​e proporcionar credibilidade às demonstrações financeiras e outros relatórios da administração.</p>
                <p>A auditoria também identifica deficiências no sistema de controle interno e no sistema financeiro e apresenta recomendações para melhorá-los</p>
                <p>As auditorias podem diferir substancialmente, dependendo de seus objetivos, das atividades para os quais se utilizam as auditorias e dos relatórios que se espera receber dos auditores.</p>
                <p>Em geral, as auditorias podem ser classificadas em três grupos:</p>
                <ol>
                <li>auditoria financeira;</li>
                <li>auditoria de cumprimento e</li>
                <li>auditoria operacional.</li>
                </ol>
                <p class="text-center"><strong>AUDITORIA FINANCEIRA</strong></p>
                <p>No caso da auditoria financeira, há interesse na auditoria das demonstrações financeiras da entidade como um todo.</p>
                <p>O objetivo geral de uma auditoria das demonstrações financeiras é fazer com que o auditor expresse uma opinião sobre se as demonstrações financeiras estão razoavelmente apresentadas de acordo com os princípios de contabilidade geralmente aceitos.</p>
                <p class="text-center"><strong>AUDITORIA DE CUMPRIMENTO E OPERACIONAL</strong></p>
                <p>A auditoria de cumprimento e a auditoria operacional têm objetivos específicos e podem ou não estar relacionadas à contabilidade de uma entidade. Normalmente, a contabilidade é base destes exames. Daí sua importância para diferentes usuários e objetivos.</p>
                <p>A auditoria de cumprimento engloba a revisão, comprovação e avaliação dos controles e procedimentos operacionais de uma entidade.</p>
                <p>A auditoria operacional é um exame mais amplo da administração, recursos técnicos e desempenho de uma organização. O propósito desta auditoria é medir o grau em que as atividades da entidade estão alcançando seus objetivos.</p>'
        ],
        [
            'title'     => 'Digitalização',
            'icon'      => 'icone-prefeituras',
            'subtitle'  => 'A organização é importante',
            'content'   => '<p>A organização é importante em tudo que fazemos e a falta dela impacta diretamente a produtividade no trabalho ou até na vida pessoal.</p>

                <p>Com o crescente volume de informações e documentos que circulam dentro das empresas, independente de seu porte, torna-se cada vez mais necessário se preocupar com a organização de arquivos.</p>

                <p>Quanto mais material, mais complexo fica seu manuseio. E tendo em vista a velocidade com que o mercado exige respostas hoje, perder eficiência na relação com os documentos da empresa pode desencadear grandes prejuízos.</p>

                <p><strong>Digitalização de documentos</strong></p>

                <p>Muito se fala no processo de organização de arquivos para as empresas e a digitalização de documentos é muito importante. Mas o que é a digitalização? É você transformar um documento impresso em documento digital, utilizando um scanner profissional.</p>

                <p>Uma ação importante para a qualidade dos processos e serviços realizados em empresas e pode ser adotada para a vida pessoal.</p>

                <p><strong>Etapas da organização de arquivos</strong></p>

                <p>A organização de arquivos é importantíssima para o funcionamento das empresas e até para nossa vida pessoal. Para que essa organização de arquivos seja bem feita, é necessário muita dedicação e conhecimento da corporação, suas hierarquias, seus setores e fluxo de trabalho.</p>

                <p>Ordenar e tratar arquivos de forma adequada demanda tempo e uma metodologia bem clara que permita o acesso rápido a uma informação específica. Isso passa pela avaliação de todo material já arquivado e o monitoramento dos documentos que trafegam na empresa, para que tudo seja organizado em seu devido lugar.</p>

                <p>As etapas para organização de arquivos de maneira eficiente são descritas como levantamento de dados, planejamento, classificação de documentos, digitalização de documentos, armazenamento de arquivos e documentos.</p>

                <p><strong>Levantamento de dados</strong></p>

                <p>Para fazer um processo de organização de arquivos, é necessário conhecer cada parte da empresa, seja o fluxo de funcionamento, documentos gerados e recebidos, o estatuto, o regimento interno, estrutura ou hierarquia, é preciso entender todo esse processo para coletar o máximo de informação possível.</p>

                <p>O objetivo é analisar o gênero dos documentos, os formulários utilizados para controle, o volume e estado de conservação do acervo, seu arranjo e a existência de registros e protocolos, bem como a média de arquivamentos.</p>

                <p>Devem ser identificadas também a localização e infraestrutura do arquivo, sem esquecer de efetuar o levantamento dos recursos humanos, seu número, formação e salário.</p>

                <p><strong>Planejamento</strong></p>

                <p>A fase de planejamento é essencial, pois nela se esboçam os métodos a serem definidos para que a organização seja eficiente: arquivamento, classificação de documentos, tipo de ordem que os documentos serão armazenados.</p>

                <p>Na fase de elaboração do plano arquivístico, deve ser levado em consideração as necessidades da instituição, sem desconsiderar jamais as disposições legais referentes.</p>

                <p>Outro ponto a levar em consideração é a divisão dessa organização por tipo de materiais, cuidados específicos de armazenagem com cada um deles, definição de quem terá acesso a quais documentos, etc.</p>

                <p><strong>Classificação de documentos</strong></p>

                <p>Os documentos podem e devem ser ordenados de maneira diferenciada (por assunto, nome, número, data ou local) e também podem ser empregados diferentes métodos.</p>

                <p>Porém, é necessário realizar uma cuidadosa análise das atividades desenvolvidas pela organização e pela observação das solicitações dos documentos nos arquivos antes de iniciar a classificação sob a qual que serão organizados. Feito isso, é hora de definir o método principal e os auxiliares a serem implantados.</p>

                <p>Assim como o método, o arranjo, que significa a ordenação dos documentos em fundos (fonte geradora de documentos como a administração, a contabilidade, os recursos humanos, entre outros) é uma das funções mais importantes em um arquivo e deve ser desenvolvido por profissionais habilitados e especialistas na área de gestão de documentos.</p>

                <p><strong>Os principais métodos de arquivamento utilizados podem ser apresentados da seguinte forma:</strong></p>

                <p><strong>Alfabético​</strong> &ndash; este tipo de classificação de documentos é utilizado quando o elemento principal a ser considerado é o nome e pode ser chamado de sistema direto, pois a pesquisa é feita diretamente no arquivo por ordem alfabética. Este método é bastante rápido, direto e de fácil utilização.</p>

                <p><strong>Geográfico​</strong> &ndash; também é do sistema direto, em que a busca é realizada pelos elementos, procedência ou local, que estão organizados em ordem alfabética.</p>

                <p><strong>Numérico​</strong> &ndash; este método deve ser utilizado quando o elemento principal é um número, sendo considerado sistema indireto, pois, para localizar um documento é necessário recorrer a um índice alfabético de assunto, que fornecerá o número sob o qual o documento foi organizado.</p>

                <p><strong>Assunto ou ideográficos​</strong> &ndash; este método é bastante utilizado, mas não é de fácil aplicação porque depende de interpretação dos documentos sob análise e diante disso requer grande conhecimento das atividades institucionais e da utilização de vocabulários controlados. Podem ser apresentados alfabética ou numericamente.</p>

                <p><strong>Digitalização de documentos</strong></p>

                <p>Após todo o processo para planejamento e classificação de documentos, a digitalização é um importante passo para que esse processo seja otimizado.</p>

                <p><strong>Vantagens da digitalização:</strong></p>

                <ul>
                    <li>
                    <p>Redução do tempo nas atividades diárias que exigem a busca e análise de documentos;</p>
                    </li>
                    <li>
                    <p>Redução de perda de documentos;</p>
                    </li>
                    <li>
                    <p>Compartilhamento entre funcionários da mesma empresa;</p>
                    </li>
                </ul>
                    <p>Acesso restrito a usuários de acordo com suas necessidades de trabalho.</p>

                    <p>Armazenamento de arquivos e documentos</p>

                    <p>Esta é a última parte deste processo e requer muita atenção após todo o processo de classificação e digitalização para que documentos não sejam arquivados de maneira errada.</p>

                    <p>Para fazer o arquivamento de documentos, existem alguns métodos que vamos apresentar a seguir.</p>

                    <p>Principais métodos de armazenamento</p>

                    <p>Armazenar documentos nem sempre é uma tarefa fácil, já que exige sobretudo, organização e senso de importância, uma vez que perdê-los pode trazer graves consequências.</p>

                    <p>Por isso, todo o cuidado é pouco na manutenção e armazenamento de documentos que, na maioria das vezes, não tem valor aos olhos de um leigo, mas analisados sob o ponto de vista jurídico ou histórico tem valor inestimável.</p>

                    <p>A organização desses documentos é tão importante que, segundo uma pesquisa realizada pela ABGD (Associação Brasileira das Empresas de Gestão de Documentos), o profissional brasileiro pode perder até 2 horas tentando encontrar documentos importantes.</p>

                <p>Isso acaba tornando o clima organizacional pesado, pois outras pessoas podem deixar de exercer funções e responsabilidades para se dedicarem à tarefa de encontrar um papel em arquivo físico perdido no meio de milhares, sendo que, em muitos casos, nem mesmo a pessoa que o arquivou faz a mínima ideia de onde esteja guardado.</p>

                <p>Por isso destacamos dois métodos muito utilizados para armazenamento de documentos digitais.</p>

                <p><strong>Pastas separadas</strong></p>

                <p>Para armazenar arquivos eletrônicos, o mais comum é criar pastas separadas pelo tipo de documento ou por fornecedores e clientes, dependendo da atividade da empresa e da classificação que foi adotada no planejamento que falamos anteriormente.</p>

                <p>Só tem um &ldquo;porém&rdquo; caso o armazenamento seja feito em pastas. O volume de documentos vai ocupar um espaço significativo no servidor da empresa.</p>

                <p>E posteriormente pode se tornar uma dor de cabeça, já que para manter as empresas seguras vai ser necessário gerar backups, que também ocuparão espaço considerável nos HDs dos servidores.</p>

                <p><strong>GED &ndash; Gerenciamento Eletrônico de Documentos</strong></p>

                <p>O Gerenciamento Eletrônico de Documentos &ndash; GED, é uma maneira moderna, simples, segura e muito eficiente para fazer o armazenamento dos documentos.</p>

                <p>O Keeva é um GED e não ocupa espaço no servidor das empresas e ainda apresenta funcionalidades que facilitam a vida dos usuários. Caso queiram buscar qualquer documento, ou compartilhá-los com os funcionários, o Keeva apresenta essas funcionalidades e outras mais.</p>

                <p><strong>Vantagens do GED</strong></p>

                <ul>
                    <li>
                    <p>Busca fácil e ágil: rápido acesso aos documentos através de um método de busca aplicado;</p>
                    </li>
                    <li>
                    <p>Conservação dos documentos: diferente do arquivo físico, uma vez que ele é digitalizado sua manutenção em formato eletrônico é permanente, ou até quando for necessário mantê-lo;</p>
                    </li>
                    <li>
                    <p>Segurança: proteção das informações, com permissões específicas para cada tipo de funcionário;</p>
                    </li>
                    <li>
                    <p>Ordem: organização dos documentos por categorias, temas, nível de importância e data;</p>
                    </li>
                    <li>
                    <p>Pesquisa correta e prática: busca assertiva, permitindo ao funcionário localizar exatamente o arquivo que precisa.</p>
                    </li>
                </ul>
                '
        ],
    ];
    }
}
