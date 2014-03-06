## Statamic add-on modifiers : pluck and unpluck

### Description

This is a pair of super-simple statamic modifiers (filters) that allow the extraction of a contigous block of content from a page or post, without having to define a content variable that contains redundant information.

These two modifiers work by using two defined 'content identification' beginning and ending character strings.  

The first modifier is *pluck*. This modifier allows the user to insert the set of pre-defined character strings in any content area (the stuff below the YAML front matter) that will mark the beginning and the end of the content to be 'plucked out' and displayed. This is more flexible than the truncate modifier since its position can vary depending on the content and is not fixed to a specific number of characters. The excerpt can therefore end at a sensible position in the content.

The second modifier is *unpluck*. This modifer is used in conjuction with the *pluck* modifier to strip out the predefined character strings from the content area and return it *sans* string. If the character strings are not present, it does nothing.

### Installation

Drop the folders *pluck* and *unpluck* in the add-ons folder in your Statamic project. Inside each folder is the modifier .php file. 

Both files contain constants that define the strings to be used in the content area to define the beginning and end of the portion of the content to be plucked. Right now, this strings are ```'[='``` for the beginning and ```'=]'``` for the end of the content block to be plucked. This can be changed to whatever strings you want, but beware that some string combinations will confuse the parser and will either deliver an empty string or launch the php into orbit. I would recommend leaving them as is, and changing them only if you have some real need to do so. 

Another constant that can be changed in the mod.excerpt.php file is the continuation string. Right now this string is set to display a right arrow ```'&rArr;'``` after the excerpt. It can be set to ellipsis ```'&hellip;'``` or even an empty string.

### Usage

#### Use inside the content area

When adding content, the pre-defined 'excerpt-definition' strings are used to mark the region where the content is to be extracted.

So a blog posting might look like this with the default 'excerpt-definition' strings:

```
---
title: A sample post
categories:
  - trivia
  - grammar
---
Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
[=Porro, maiores, doloribus, eius saepe cupiditate mollitia 
facere repellendus odio nihil aperiam enim fugiat ducimus 
hic.=] Repellat, quam praesentium illo incidunt reprehenderit?

Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
Quibusdam, ad, magni, rem, ullam assumenda fugiat quaerat 
laudantium error sit saepe dolore voluptatem soluta voluptas. 
Doloremque et harum corporis officia iste!
```
And the content that will be returned is the section between 'Porro' and 'hic.' whenever it is passed through the *pluck* modifier.


#### Use inside a template

The main use of this modifier add-on is to truncate content that is displayed in listings such as a blog or journal. The excerpt modifier is essentially a filter, so a super-simple blog listing template might look like this:

```
<li >
	<h1>
		{{ title }}
	</h1>
	<p>
		posted on {{ date }}
	</p>
	
	{{ content|pluck }}
</li>
```

Naturally, an issue is that when you want to display the entire content area, those pesky 'excerpt-definition' strings are still there. So any time you need to display all the content, simply pass the content through the *unpluck* modifier, which will strip out the strings if present.

A typical whole-content template might look like this:

```
<article >
	<h1>{{ title}}</h1>
	<p>
		Recorded on {{ date }}
	</p>
	{{ content|unpluck }}
</article>
```
### Caveats and warnings

Note that Statamic modifiers should have NO spaces between before or after the pipe ```'|'```!

I'm already using these modifiers, and I did notice one oddball thing - if you put the excerpt-block termination string in the middle of a markdown blockquote ( after the > in markdown format), the Statamic parser does not finish off the blockquote tag and everything below it ends up in the blockquote. The way to avoid this is 

1. either avoid using the termination string in the middle of a blockquote, 

or

2. make sure a blank line is between the end of the blockquote and the termination string.







