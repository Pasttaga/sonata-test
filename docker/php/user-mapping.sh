#!/bin/bash

isGroupExist() {
    if ! grep -q "^$DOCKER_RUN_GROUP_NAME:[.]*" /etc/group > /dev/null 2>&1
    then
        return 1
    fi
}

isUserExist() {
    if ! id -u $DOCKER_RUN_USER_NAME > /dev/null 2>&1
    then
        return 1
    fi
}

checkEnvVariable() {
    if [ "$1" = "" ]
    then
        echo -e "\033[31menv variable \"$2\" not defined\033[0m"
        exit 1
    fi
}

checkEnvVariable "$DOCKER_RUN_USER_NAME" "DOCKER_RUN_USER_NAME"
checkEnvVariable "$DOCKER_RUN_USER_ID" "DOCKER_RUN_USER_ID"
checkEnvVariable "$DOCKER_RUN_GROUP_NAME" "DOCKER_RUN_GROUP_NAME"
checkEnvVariable "$DOCKER_RUN_GROUP_ID" "DOCKER_RUN_GROUP_ID"

if ! isGroupExist
then
    echo "creating group..."
	groupadd -f -g $DOCKER_RUN_GROUP_ID $DOCKER_RUN_GROUP_NAME
	echo -e "group $DOCKER_RUN_GROUP_NAME ($DOCKER_RUN_GROUP_ID) created"
fi

if ! isUserExist
then
    echo "creating user..."
	useradd -u $DOCKER_RUN_USER_ID -g $DOCKER_RUN_USER_NAME $DOCKER_RUN_GROUP_NAME -G sudo --create-home
	echo -e "user $DOCKER_RUN_USER_NAME ($DOCKER_RUN_USER_ID) created"
fi
