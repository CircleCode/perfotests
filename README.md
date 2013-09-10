# Perfo test suite

This suite allows to test some scenarios for hoaproject/Compiler#6

It is based on facebook/xhprof

## Run the tests

```bash
# install xhprof on your php environment (pecl is an easy way to do it)
pecl install xhprof-beta

# retrieve xhprof web gui
git submodule update --init

#launch tests
./test.sh

# view results
xdg-open http://localhost:8000
```

Note : test.sh accepts 2 arguments :

-   number of iterations
-   number of tokens included in the parsed string