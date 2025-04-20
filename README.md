# JoomScripts – Execute Scripts PHP Personalizados no Joomla 5

> 🔧 Adaptação moderna do antigo componente **JCode**, agora compatível com Joomla 5.

## ✨ O que é o JoomScripts?

JoomScripts é um componente leve e funcional que permite rodar **scripts PHP personalizados diretamente pelo backend do Joomla**. Ideal para desenvolvedores que precisam testar funções, automatizar rotinas internas, gerar relatórios, entre outras tarefas técnicas, sem criar um plugin ou módulo completo.

Esta versão é baseada no projeto original **JCode**, criado por [Iacopo Guarneri](http://www.iacopo-guarneri.me/)), e adaptada para o Joomla 5 por **Jeison Ferreira**.

---

## 📁 Onde salvar os arquivos PHP?

Todos os seus scripts devem ser salvos na pasta:

```
administrator/components/com_joomscripts/source/
```

Exemplo:
```
administrator/components/com_joomscripts/source/relatorio.php
```

---

## 🧩 Como criar um item de menu para rodar o script?

1. Vá até **Menus > [Seu menu] > Novo item**  
2. Escolha o tipo de item: **JoomScripts**
3. Na aba **JoomScripts**, informe o nome do seu arquivo PHP (ex: `relatorio.php`)
4. Salve e acesse o item de menu — o script será executado automaticamente

---

## ⚠️ Cuidados

- Apenas arquivos diretos como `teste.php`, `exportar.php`, etc. são suportados. Subpastas não são permitidas.
- Scripts são executados diretamente — revise bem antes de rodar para evitar riscos de segurança.
- Ideal para uso em ambientes controlados, como backoffices ou admin tools privadas.

---

## 📦 Instalação

1. Clone ou baixe o repositório
2. Instale o componente via painel do Joomla 5
3. Pronto! O componente aparecerá no menu de componentes do admin

---

## 🧠 Por que usar?

- Evita a criação de plugins para tarefas pequenas
- Facilidade para rodar scripts de manutenção ou testes
- Integração direta com o painel administrativo

---

## 📃 Licença

GNU/GPL v2  
Projeto baseado no original de [[http://www.iacopo-guarneri.me](http://www.iacopo-guarneri.me)

---

## 👨‍💻 Desenvolvedor

**Jeison Ferreira**  
Adaptação, modernização e compatibilidade com Joomla 5.
