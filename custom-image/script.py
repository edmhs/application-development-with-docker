import redis
print("hello redis-py script")
r = redis.Redis(host="0.0.0.0", port=6379, db=0)
r.set('z', 'xyz')