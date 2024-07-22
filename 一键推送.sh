now=$(date "+%Y-%m-%d %H:%M:%S")
echo "Change Directory to E:/Project/LaravelTest/LaravelTest"
cd E:/Project/LaravelTest/LaravelTest
echo "开始add-commit-pull-push流程"
git add .
git commit -m "LaravelTest ver.$now"
git pull git@github.com:EasyToFind1/LaravelTest.git
git push git@github.com:EasyToFind1/LaravelTest.git
echo "推送成功！可以关闭了"
read