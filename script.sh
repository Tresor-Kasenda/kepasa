# !/bin/bash
echo "What the name of project :"
read name
if [ $name ]; then
    result = $(composer create-project --prefer-dist laravel/laravel $name)
    echo $result
    echo "Project $name has created with success"
    mv -i $result $HOME/Vides/
    cd result
    echo "$result directory changed"
    git init
    git add .
    echo "Add message of commit"
    read message
    if [ $message ]; then
        git commit -m "$message"
        git push origin main
    fi
fi
