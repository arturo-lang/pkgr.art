<p align="center"><img align="center" width="350" src="https://raw.githubusercontent.com/arturo-lang/pkgr/main/logo.png"/></p>
<p align="center">
  <b>The main registry for Arturo's package manager</b>
  <br><br>
  <img src="https://img.shields.io/github/license/arturo-lang/pkgr.art?style=for-the-badge">
  <img src="https://img.shields.io/badge/language-Arturo-orange.svg?style=for-the-badge">
  <img src="https://img.shields.io/github/actions/workflow/status/arturo-lang/pkgr.art/verify.yml?branch=main&style=for-the-badge">
</p>
--- 
 
<!--ts-->

* [What is a package?](#what-is-a-package)
* [Creating packages](#creating-packages)
  * [How do I create a package?](#how-do-I-create-a-package)
  * [How do I publish a new package?](#how-do-I-publish-a-new-package)
* [Using packages](#using-packages)
  * [How do I use a package?](#how-do-I-use-a-package)
* [License](#license)   

<!--te-->
 
---

The main registry for Arturo's package manager

## What is a package?

Trying to be as brief as possible, an Arturo package could be defined as a folder with an entry file in it (by default: `main.art`).

So let's say you create a new folder `myPackage` and create a `main.art` in there with some code in it, technically speaking, *that* is a package.

The idea of packages in Arturo is simply a way of making code portability easier and also allowing for their centralized distribution (through our main pkgr.art) registry. So, think of: *gems*, *modules*, you-name-it. Only we'll be trying to make things work in an even simpler way, without over-complicating our lives too much.

## Creating packages

### How do I create a package?

As I said above, a package can be just a folder with one single file in it (`main.art`).

But of course, you can fine-tune more in case you wish.

#### The `info.art` configuration file

The way to fine-tune a package is by including an extra `info.art` in your package which is meant to add extra info about how your package behaves.

Let's have a look at an example `info.art` configuration:

```red
entry: "mayownmain"
depends: [
  [someOtherPackage >= 0.0.2]
]
requires: 0.9.83
```

As you can see, all this file *may* contain - note: all fields are optional - is basically a few more details:

- **entry**: an alternative entry file, if you don't want to use `main.art`
- **depends**: a list of dependencies (= other packages your own package needs)
- **requires**: the minimum Arturo version your package is meant to work with

As you can see, that's no rocket science.

### How do I "publish" a new package?

In order to publish a new package so that it's universally available via the main package registry (pkgr.art), all you have to do is add a tiny PR to this repo, and add a only line entry to the [`packages/list.art`](https://github.com/arturo-lang/pkgr.art/blob/main/packages/list.art) file. Yes, it's as easy as that: a name you want for your package and the repo (owner/repo) of your project. Once the PR has been merged, your package will be instantly available!

Also: you don't have to add any description/documentation or anything like that. What will be extracted is exactly what you have in the repo - so, make sure everything is neat and tidy in there! 😉

And another detail: since Arturo's package manager is version-aware, in order for us to be able to actually use versions for the submitted packages, make sure each of your versions is actually a published "Release" with a proper tag (by proper, I'd say anything that is SemVer compatible, like: `0.0.2` or `v0.0.3` if you prefer that).

In any case, we're here to guide you through the whole process! Not to worry!

## Using packages

### How do I "use" a package?

The main way of using a package is by `import`ing in your Arturo code. And it's as simple as:

```red
import "dummy"
```

If the package has not already been downloaded, it will and you will be able to use it just fine without noticing anything. If it's already there, then it will be used automatically.

A few examples, taken from `import`'s own documentation that show a few more bells and whistles:

```red
import "dummy"                      ; import the package 'dummy'
do ::
    print dummyFunc 10              ; and use it :)
```

```red
import.version:0.0.3 "dummy"        ; import a specific version

import.min.version:0.0.3 "dummy"    ; import at least the give version;
                                    ; if there is a newer one, it will pull this one
```

```red
import.latest "dummy"               ; whether we already have the package or not
                                    ; always try to pull the latest version
```

```red
import "https://github.com/arturo-lang/dummy-package"
; we may also import user repositories directly

import.branch:"main" "https://github.com/arturo-lang/dummy-package"
; even specifying the branch to pull
```

```red
import "somefile.art"               ; importing a local file is possible

import "somepackage"                ; the same works if we have a folder that
                                    ; is actually structured like a package
```

```red
d: import.lean "dummy"              ; importing a package as a dictionary
                                    ; for better namespace isolation

do [
    print d\dummyFunc 10            ; works fine :)
]
```

> ⚠️ You may have noticed the use of `do` (with a block) *after* the import statements. Unfortunately, given how Arturo's parser and AST works right now, there is no way to make functions inside an imported file/package be visible at the same level of parsing/execution, hence we have to include them in a sublevel! (needless to say, this is one of the things that could be resolved in the future, I just wouldn't bet too hard on it for now)


License
===========

MIT License

Copyright (c) 2023 Arturo Programming Language

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
