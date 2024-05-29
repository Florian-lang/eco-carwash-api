#!/bin/bash

HOOKS_PATH=".git/hooks/pre-commit"

echo "#!/bin/bash" > $HOOKS_PATH
echo "docker exec \"\$(basename \"\$PWD\")-php\" composer phpstan" >> $HOOKS_PATH

chmod +x $HOOKS_PATH

echo "Hook de pre-commit créé."