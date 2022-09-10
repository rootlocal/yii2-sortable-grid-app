#!/usr/bin/env bash
rm -rf rootlocal/yii2-sortable-grid-view-docs
# set these paths to match your environment
APIDOC_PATH=./vendor/yiisoft/yii2-apidoc
OUTPUT=./rootlocal/rootlocal.github.io/yii2-sortable-grid-view-docs
apidoc="./vendor/bin/apidoc"
INPUT="./rootlocal/yii2-sortable-grid-view/src"

${apidoc} api ${INPUT} $OUTPUT/api \
  --interactive=0 \
  --guidePrefix= \
  --template="bootstrap" \
  --pageTitle="YII2 Sortable GridView" \
  --exclude="docs,vendor"

#${apidoc} api $YII_PATH/framework/,$YII_PATH/extensions \
#  $OUTPUT/api --guide=../guide-en \
#  --guidePrefix= --interactive=0

#${apidoc} guide $YII_PATH/docs/guide    \
#  $OUTPUT/guide-en --apiDocs=../api \
#  --guidePrefix= --interactive=0

#${apidoc} guide $YII_PATH/docs/guide-ru \
#  $OUTPUT/guide-ru --apiDocs=../api \
#  --guidePrefix= --interactive=0

# repeat the last line for more languages
