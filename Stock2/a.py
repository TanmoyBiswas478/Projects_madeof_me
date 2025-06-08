from queue import PriorityQueue

def best_first(graph, start, goal):
    visited = set(); q = PriorityQueue(); q.put((0, start))
    while not q.empty():
        _, node = q.get()
        if node in visited: continue
        print(node, end=' ')
        if node == goal: break
        visited.add(node)
        for n, h in graph.get(node, []):
            if n not in visited: q.put((h, n))

graph = {'A': [('B',1),('C',3)], 'B': [('D',4),('E',2)], 'E': [('G',0)], 'C':[], 'D':[], 'G':[]}
best_first(graph, 'A', 'G')
