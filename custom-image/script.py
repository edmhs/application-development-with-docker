import redis
print("hello redis-py script")
r = redis.Redis(host="3.125.48.73", port=6379, db=0)
r.incr('counter')
