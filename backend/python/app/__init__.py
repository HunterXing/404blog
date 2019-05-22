# 导入Flask
from flask import Flask
# 创建应用程序对象
app = Flask(__name__)
# 应用程序导入尚未存在的routes模块。
from app import routers